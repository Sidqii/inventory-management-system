<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Enum\Transaction\StockRequestStatus;
use App\Models\Transaction\StockRequest;
use App\Http\Requests\Transaction\ApproveStockRequest;
use App\Http\Requests\Transaction\FulfillStockRequest;
use App\Http\Requests\Transaction\StoreStockRequest;
use App\Http\Requests\Transaction\UpdateStockRequest;
use App\Http\Resources\Trasnsaction\StockRequestResource;
use App\Services\Transaction\StockRequestService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Illuminate\Support\now;

class StockRequestController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(StockRequest::class, 'stockRequest');
    }
    /**
     * Display a listing of Stock request.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $stockRequests = StockRequest::with([
            'user',
            'warehouse',
            'items.product',
            'approver',
            'completedBy',
        ])->latest()->paginate();

        return StockRequestResource::collection($stockRequests);
    }

    /**
     * Submit a request to borrow stock.
     * @param StoreStockRequest $request
     * @param StockRequestService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStockRequest $request, StockRequestService $service)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $service->createRequest($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified requested stock.
     * @param StockRequest $stockRequest
     * @param StockRequestService $service
     * @return StockRequestResource
     */
    public function show(StockRequest $stockRequest, StockRequestService $service)
    {
        return new StockRequestResource(
            $service->loadRequestRealitions($stockRequest),
        );
    }

    /**
     * Update the data that has already been submitted.
     * @param UpdateStockRequest $request
     * @param StockRequest $stockRequest
     * @param StockRequestService $service
     * @return StockRequestResource|\Throwable
     */
    public function update(UpdateStockRequest $request, StockRequest $stockRequest, StockRequestService $service)
    {
        if ($stockRequest->status !== StockRequestStatus::PENDING) {
            abort(422, 'Only pending requests can be updated.');
        }

        $data = $request->validated();

        DB::beginTransaction();

        try {
            $stockRequest->update([
                'warehouse_id' => $data['warehouse_id'],
                'note' => $data['note'] ?? null,
            ]);

            $stockRequest->items()->delete();

            $stockRequest->items()->createMany($data['items']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return $th;
        }

        return new StockRequestResource(
            $service->loadRequestRealitions($stockRequest),
        );
    }

    /**
     * Approve the submitted data.
     * @param ApproveStockRequest $request
     * @param StockRequest $stockRequest
     * @param StockRequestService $service
     * @return StockRequestResource
     */
    public function approve(ApproveStockRequest $request, StockRequest $stockRequest, StockRequestService $service)
    {
        $this->authorize('approve', $stockRequest);

        if ($stockRequest->status !== StockRequestStatus::PENDING) {
            abort(422, 'Only pending requests can be approved.');
        }

        $data = $request->validated();

        DB::beginTransaction();

        try {
            $service->approveRequset($stockRequest, $data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return new StockRequestResource(
            $service->loadRequestRealitions($stockRequest),
        );
    }

    /**
     * Reject the data that has been submitted.
     * @param StockRequest $stockRequest
     * @param StockRequestService $service
     * @return StockRequestResource
     */
    public function reject(StockRequest $stockRequest, StockRequestService $service)
    {
        $this->authorize('reject', $stockRequest);

        if ($stockRequest->status !== StockRequestStatus::PENDING) {
            abort(422, 'Only pending requests can be rejected.');
        }

        $stockRequest->update([
            'status' => StockRequestStatus::REJECTED,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return new StockRequestResource(
            $service->loadRequestRealitions($stockRequest),
        );
    }

    /**
     * Record approval of goods submissions.
     * @param FulfillStockRequest $request
     * @param StockRequest $stockRequest
     * @param StockRequestService $service
     * @return StockRequestResource
     */
    public function fulfill(FulfillStockRequest $request, StockRequest $stockRequest, StockRequestService $service)
    {
        $this->authorize('fulfill', $stockRequest);

        if ($stockRequest->status !== StockRequestStatus::APPROVED) {
            abort(422, 'Only approved requests can be fulfilled.');
        }

        $data = $request->validated();

        DB::beginTransaction();

        try {
            $service->fulfillRequest($stockRequest, $data);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return new StockRequestResource(
            $service->loadRequestRealitions($stockRequest),
        );
    }

    /**
     * Delete data that is still pending.
     * @param StockRequest $stockRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockRequest $stockRequest)
    {
        if ($stockRequest->status !== StockRequestStatus::PENDING) {
            abort(422, 'Only pending requests can be deleted.');
        }

        $stockRequest->delete();

        return response()->noContent();
    }
}
