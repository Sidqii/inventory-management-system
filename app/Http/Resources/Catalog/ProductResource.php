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
            'name' => $this->name,
            'sku' => $this->sku,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],

            'stock' => $this->stocks->sum('quantity'),
            'unit' => [
                'id' => $this->unit->id,
                'symbol' => $this->unit->symbol,
            ],

            'image' => $this->image_path,
            'description' => $this->description,

            'date' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
