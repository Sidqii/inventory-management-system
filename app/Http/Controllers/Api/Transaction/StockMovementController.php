<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Exports\StockMovementsExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Trasnsaction\StockMovementResource;
use App\Models\Transaction\StockMovement;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StockMovementController extends Controller
{
    public function export()
    {
        return Excel::download(new StockMovementsExport(), 'stock-movements.xlsx');
    }

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
            'reference.approver',
            'reference.completedBy',
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
            'reference.approver',
            'reference.completedBy',
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
