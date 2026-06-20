<?php

namespace App\Http\Resources\Trasnsaction;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockMovementResource extends JsonResource
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

            'movement_number' => $this->movement_number,
            'movement_type' => $this->movement_type,
            'note' => $this->note,

            'request_by' => UserResource::make(
                $this->reference?->user,
            ),

            'approved_by' => UserResource::make(
                $this->reference?->approver
            ),

            'completed_by' => UserResource::make(
                $this->reference?->completedBy
            ),

            'warehouse' => [
                'id' => $this->warehouse?->id,
                'code' => $this->warehouse?->code,
                'name' => $this->warehouse?->name,
            ],

            'reference' => $this->reference ? [
                'type' => class_basename($this->reference_type),
                'id' => $this->reference_id,
            ] : null,

            'items' => StockMovementItemResource::collection(
                $this->whenLoaded('items')
            ),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
