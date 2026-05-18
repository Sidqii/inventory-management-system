<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StockRequestForm;
use App\Http\Resources\Inventory\StockResource;
use App\Models\Inventory\Stock;
use Illuminate\Http\Request;

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
        $data = Stock::updateOrCreate($request->validated());

        return new StockResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
