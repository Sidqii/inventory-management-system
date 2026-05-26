<?php

namespace App\Http\Controllers\Api\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\WarehouseRequest;
use App\Models\Catalog\Warehouse;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Warehouse::class, 'warehouse');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Warehouse::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseRequest $request)
    {
        return Warehouse::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return $warehouse;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->update($request->validated());

        return $warehouse;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return response()->noContent();
    }
}
