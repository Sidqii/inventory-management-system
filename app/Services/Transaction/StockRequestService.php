<?php

namespace App\Services\Transaction;

use App\Enum\Transaction\StockMovementType;
use App\Enum\Transaction\StockRequestStatus;
use App\Models\Inventory\Stock;
use App\Models\Transaction\StockMovement;
use App\Models\Transaction\StockRequest;
use Illuminate\Support\Facades\Auth;

class StockRequestService
{
    public function generateRequestNumber()
    {
        return 'REQ-' . now()->format('YmdHis');
    }

    public function generateMovementNumber()
    {
        return 'MOV-' . now()->format('YmdHis');
    }

    public function loadRequestRealitions(StockRequest $stockRequest)
    {
        $stockRequest->load([
            'user',
            'warehouse',
            'items.product',
            'approver',
            'completedBy',
        ]);

        return $stockRequest;
    }


    public function createRequest(array $data)
    {
        $stockRequest = StockRequest::create([
            'user_id' => Auth::id(),
            'warehouse_id' => $data['warehouse_id'],
            'request_number' => $this->generateRequestNumber(),
            'status' => StockRequestStatus::PENDING,
            'note' => $data['note'] ?? null,
        ]);

        $stockRequest->items()->createMany($data['items']);

        return $stockRequest;
    }

    public function approveRequset(StockRequest $stockRequest, array $data)
    {
        foreach ($data['items'] as $itemData) {
            $item = $stockRequest->items()->where('id', $itemData['id'])->firstOrFail();

            $item->update([
                'quantity_approved' => $itemData['quantity_approved'],
                'note' => $itemData['note'] ?? $item->note,
            ]);
        }

        $stockRequest->update([
            'status' => StockRequestStatus::APPROVED,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
    }

    public function fulfillRequest(StockRequest $stockRequest, array $data)
    {
        // create stock_movement header
        $stockMovement = StockMovement::create([
            'user_id' => Auth::id(),
            'warehouse_id' => $stockRequest->warehouse_id,
            'reference_id' => $stockRequest->id,
            'reference_type' => $stockRequest::class,
            'movement_type' => StockMovementType::OUT,
            'movement_number' => $this->generateMovementNumber(),
            'note' => $stockRequest->note,
        ]);

        // temporary variable to collect movement_items
        $movementItems = [];

        // process each requested item
        foreach ($data['items'] as $itemData) {
            $item = $stockRequest->items()->where('id', $itemData['id'])->firstOrFail();

            // update quantity_issued
            $item->update([
                'quantity_issued' => $itemData['quantity_issued'],
                'note' => $itemData['note'] ?? $item->note,
            ]);

            // finde or create stock balance
            $stock = Stock::firstOrCreate(
                [
                    'product_id' => $item->product_id,
                    'warehouse_id' => $stockRequest->warehouse_id,
                ],
                [
                    'quantity' => 0,
                ]
            );

            // validate available stock
            if ($stock->quantity < $itemData['quantity_issued']) {
                abort(422, 'Insufficient stock.');
            }

            // reduce stock quantity
            $stock->decrement('quantity', $itemData['quantity_issued']);

            // collect movement_item data
            $movementItems[] = [
                'product_id' => $item->product_id,
                'quantity' => $itemData['quantity_issued'],
            ];
        }

        // create stock_movement_items
        $stockMovement->items()->createMany($movementItems);

        // mark request as fulfilled
        $stockRequest->update([
            'status' => StockRequestStatus::FULFILLED,
            'completed_by' => Auth::id(),
            'completed_at' => now(),
        ]);
    }
}
