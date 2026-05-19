<?php

namespace App\Http\Resources\Trasnsaction;

use App\Http\Resources\Catalog\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockRequestItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,

            'product' => [
                'id' => $this->product->id,
                'sku' => $this->product->sku,
                'name' => $this->product->name,
            ],

            'quantity_requested' => $this->quantity_requested,
            'quantity_approved' => $this->quantity_approved,
            'quantity_issued' => $this->quantity_issued,

            'note' => $this->note,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
