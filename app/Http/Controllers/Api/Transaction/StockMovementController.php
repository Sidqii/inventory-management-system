<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Trasnsaction\StockMovementResource;
use App\Models\Transactions\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockMovents = StockMovement::with([
            'user',
            'warehouse',
            'items.product',
            'reference',
        ])->latest()->paginate();

        return StockMovementResource::collection($stockMovents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StockMovement $stockMovement)
    {
        $stockMovement->load([
            'user',
            'warehouse',
            'items.product',
            'reference',
        ]);

        return new StockMovementResource($stockMovement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
