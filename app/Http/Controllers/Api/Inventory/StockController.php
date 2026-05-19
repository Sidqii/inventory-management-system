<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StockRequestForm;
use App\Http\Resources\Inventory\StockResource;
use App\Models\Inventory\Stock;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock = Stock::with(['product', 'warehouse'])->latest()->paginate();

        return StockResource::collection($stock);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockRequestForm $request)
    {
        $stock = Stock::updateOrCreate($request->validated());

        return new StockResource($stock);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return new StockResource($stock);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockRequestForm $request, Stock $stock)
    {
        $data = $request->validated();

        $stock->update($data);

        $stock->refresh();

        return new StockResource($stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return response()->noContent();
    }
}
