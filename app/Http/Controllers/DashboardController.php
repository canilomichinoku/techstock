<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')->count();

        $lowStockList = Product::whereColumn('stock', '<=', 'min_stock')
            ->orderBy('stock')
            ->limit(5)
            ->get();

        $categoriesWithProducts = Category::withCount('products')
            ->whereHas('products')
            ->orderBy('products_count', 'desc')
            ->get();

        $categoryLabels = $categoriesWithProducts->pluck('name')->toArray();
        $categoryData = $categoriesWithProducts->pluck('products_count')->toArray();

        $lastMovements = StockMovement::with('product')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts', 'totalCategories', 'totalSuppliers',
            'lowStockProducts', 'lowStockList',
            'categoryLabels', 'categoryData', 'lastMovements'
        ));
    }
}