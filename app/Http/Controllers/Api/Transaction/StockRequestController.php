<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Enum\Transaction\StockRequestStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\ApproveStockRequest;
use App\Http\Requests\Transaction\FulfillStockRequest;
use App\Http\Requests\Transaction\StoreStockRequest;
use App\Http\Requests\Transaction\UpdateStockRequest;
use App\Http\Resources\Trasnsaction\StockRequestResource;
use App\Models\Inventory\Stock;
use App\Models\Transactions\StockMovement;
use App\Models\Transactions\StockRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Illuminate\Support\now;

class StockRequestController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(StoreStockRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $stockRequest = StockRequest::create([
                'user_id' => Auth::id(),
                'warehouse_id' => $data['warehouse_id'],
                'request_number' => 'REQ-' . now()->format('YmdHis'),
                'status' => StockRequestStatus::PENDING,
                'note' => $data['note'] ?? null,
            ]);

            $stockRequest->items()->createMany($data['items']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        $stockRequest->load([
            'user',
            'warehouse',
            'items.product'
        ]);

        return new StockRequestResource($stockRequest);
    }

    /**
     * Display the specified resource.
     */
    public function show(StockRequest $stockRequest)
    {
        $stockRequest->load([
            'user',
            'warehouse',
            'items.product',
            'approver',
            'completedBy',
        ]);

        return new StockRequestResource($stockRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, StockRequest $stockRequest)
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

        $stockRequest->load([
            'user',
            'warehouse',
            'items.product',
            'approver',
            'completedBy',
        ]);

        return new StockRequestResource($stockRequest);
    }

    /**
     * Approve requests and update status
     */
    public function approve(ApproveStockRequest $request, StockRequest $stockRequest)
    {
        if ($request->status !== StockRequestStatus::PENDING) {
            abort(422, 'Only pending requests can be approved.');
        }

        $data = $request->validated();

        DB::beginTransaction();

        try {
            foreach ($data['items'] as $itemData) {
                $item = $stockRequest->items()->where('id', $itemData['id'])->firstOrFail();

                $item->update([
                    'quantity_approved' => $itemData['quantity_approved'],
                ]);
            }

            $stockRequest->update([
                'status' => StockRequestStatus::APPROVED,
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        $stockRequest->load([
            'user',
            'warehouse',
            'items.product',
            'approver',
            'completedBy',
        ]);

        return new StockRequestResource($stockRequest);
    }

    public function fulfill(FulfillStockRequest $request, StockRequest $stockRequest)
    {
        if ($stockRequest->status !== StockRequestStatus::APPROVED) {
            abort(422, 'Only approved requests can be fulfilled.');
        }

        $data = $request->validated();

        DB::beginTransaction();

        try {
            $stockMovement = StockMovement::create([
                'user_id' => Auth::id(),
                'warehouse_id' => $stockRequest->warehouse_id,
                'reference_type' => $stockRequest::class,
                'reference_id' => $stockRequest->id,
                'movement_type' => 'OUT',
                'movement_number' => 'MOV-' . now()->format('YmdHis'),
                'note' => $stockRequest->note,
            ]);

            $movementItems = [];

            foreach ($data['items'] as $itemData) {
                $item = $stockRequest->items()->where('id', $itemData['id'])->firstOrFail();

                $item->update([
                    'quantity_issued' => $itemData['quantity_issued'],
                ]);

                $stock = Stock::firstOrCreate(
                    [
                        'product_id' => $item->product_id,
                        'warehouse_id' => $stockRequest->warehouse_id,
                    ],
                    [
                        'quantity' => 0,
                    ]
                );

                if ($stock->quantity < $itemData['quantity_issued']) {
                    abort(422, 'Insufficient stock.');
                }

                $stock->decrement('quantity', $itemData['quantity_issued']);

                $movementItems[] = [
                    'product_id' => $item->product_id,
                    'quantity' => $itemData['quantity_issued'],
                ];
            }

            $stockMovement->items()->createMany($movementItems);

            $stockRequest->update([
                'status' => StockRequestStatus::FULFILLED,
                'completed_by' => Auth::id(),
                'completed_at' => now(),
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        $stockRequest->load([
            'user',
            'warehouse',
            'items.product',
            'approver',
            'completedBy',
        ]);

        return new StockRequestResource($stockRequest);
    }

    /**
     * Remove the specified resource from storage.
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
