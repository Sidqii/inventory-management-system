<?php

namespace App\Exports;

use App\Models\Transaction\StockMovement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockMovementsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return StockMovement::with([
            'user',
            'warehouse',
            'items.product',
            'reference',
            'reference.approver',
        ])->latest()->get()->flatMap(function ($movement) {
            return $movement->items->map(function ($item) use ($movement) {
                return [
                    'movement_number' => $movement->movement_number,
                    'movement_type' => $movement->movement_type,
                    'warehouse_code' => $movement->warehouse?->code,
                    'warehouse_name' => $movement->warehouse?->name,
                    'requested_by' => $movement->reference?->user?->name,
                    'approved_by' => $movement->reference?->approver?->name,
                    'product_sku' => $item->product?->sku,
                    'product_name' => $item->product?->name,
                    'quantity' => $item->quantity,
                    'note' => $movement->note,
                    'created_at' => $movement->created_at?->format('Y-m-d H:i:s'),
                ];
            });
        });
    }

    public function headings(): array
    {
        return [
            'Movement Number',
            'Movement Type',
            'Warehouse Code',
            'Warehouse Name',
            'Requested By',
            'Approved By',
            'Product SKU',
            'Product Name',
            'Quantity',
            'Note',
            'Created At',
        ];
    }
}
