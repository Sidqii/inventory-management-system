<?php

namespace App\Http\Resources\Catalog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'sku' => $this->sku,
            'name' => $this->name,

            'unit' => [
                'id' => $this->unit->id,
                'symbol' => $this->unit->symbol,
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],

            'stock' => [
                'quantity' => $this->stocks->sum('quantity'),
            ],

            'image' => $this->image_path,
            'description' => $this->description,

            'date' => [
                'created_at' => $this->created_at->format('d M Y, H:i'),
                'updated_at' => $this->updated_at->format('d M Y, H:i'),
            ]
        ];
    }
}
