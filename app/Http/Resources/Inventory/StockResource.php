<?php

namespace App\Http\Resources\Inventory;

use App\Http\Resources\Catalog\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'sku' => $this->product->sku,
            ],

            'quantity' => $this->quantity,

            'warehouse' => [
                'id' => $this->warehouse->id,
                'code' => $this->warehouse->code,
                'location' => $this->warehouse->location,
            ],
        ];
    }
}
