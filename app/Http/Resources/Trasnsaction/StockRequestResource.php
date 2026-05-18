<?php

namespace App\Http\Resources\Trasnsaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockRequestResource extends JsonResource
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

            'request_number' => $this->request_number,
            'status' => $this->status,
            'note' => $this->note,

            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
                'email' => $this->user?->email,
            ],

            'warehouse' => [
                'id' => $this->warehouse?->id,
                'code' => $this->warehouse?->code,
                'name' => $this->warehouse?->name,
            ],

            'approved_by' => $this->approver ? [
                'id' => $this->approver->id,
                'name' => $this->approver->name,
                'email' => $this->approver->email,
            ] : null,
            'approved_at' => $this->approved_at,

            'completed_by' => $this->completedBy ? [
                'id' => $this->completedBy->id,
                'name' => $this->completedBy->name,
                'email' => $this->completedBy->email,
            ] : null,
            'completed_at' => $this->completed_at,

            'items' => StockRequestItemResource::collection(
                $this->whenLoaded('items')
            ),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
