<?php

namespace App\Http\Resources\Catalog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttachmentResource extends JsonResource
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

            'file_name' => $this->file_name,
            'file_type' => $this->file_type,
            'file_size' => $this->file_size,

            'file_path' => $this->file_path,

            'file_url' => url(Storage::url($this->file_path)),

            // 'uploaded_by' => [
            //     'id' => $this->uploader->id,
            //     'name' => $this->uploader->name,
            // ],
            'uploaded_at' => $this->created_at,
        ];
    }
}
