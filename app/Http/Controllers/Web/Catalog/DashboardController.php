<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Product;
use App\Models\Inventory\Stock;
use App\Models\Transaction\StockMovement;
use App\Models\Transaction\StockRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('catalog.dashboard', [
            'products' => Product::count(),

            'stock' => Stock::sum('quantity'),

            'totalRequests' => StockRequest::count(),
            'totalMovements' => StockMovement::count(),

            'latestRequests' => StockRequest::with([
                'user',
                'warehouse',
                'items.product',
                'approver',
                'completedBy',
            ])->latest()->get()
        ]);
    }
}
