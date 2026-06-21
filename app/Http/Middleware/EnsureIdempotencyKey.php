<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\IdempotencyKey;
use Illuminate\Http\Request;

class EnsureIdempotencyKey
{
    public function handle(Request $request, Closure $next)
    {
        $key = $request->header('Idempotency-Key');

        if (!$key) {
            return response()->json([
                'message' => 'Idempotency-Key header is required.',
            ], 422);
        }

        $record = IdempotencyKey::where('user_id', $request->user()?->id)->where('key', $key)->first();

        if ($record && $record->response_body) {
            return response()->json(
                $record->response_body,
                $record->status_code ?? 200
            );
        }

        $response = $next($request);

        IdempotencyKey::create([
            'user_id' => $request->user()?->id,
            'key' => $key,
            'method' => $request->method(),
            'path' => $request->path(),
            'status_code' => $response->getStatusCode(),
            'response_body' => json_decode($response->getContent(), true),
        ]);

        return $response;
    }
}
