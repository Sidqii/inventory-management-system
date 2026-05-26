<?php

namespace App\Http\Controllers\Api\Attachments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\AttachmentRequest;
use App\Http\Resources\Catalog\AttachmentResource;
use App\Models\Catalog\Attachment;
use App\Models\Catalog\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Attachment::class, 'attachment');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        throw new \Exception("Not implemented");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttachmentRequest $request, Product $product)
    {
        $file = $request->file('file');

        $path = $file->store('attachments', 'public');

        $attachment = $product->attachments()->create([
            'user_id' => Auth::id(),
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        // $attachment = $attachment->fresh();

        return new AttachmentResource($attachment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        throw new \Exception("Not implemented");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        throw new \Exception("Not implemented");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment)
    {
        Storage::disk('public')->delete($attachment->file_path);

        $attachment->delete();

        return response()->noContent();
    }
}
