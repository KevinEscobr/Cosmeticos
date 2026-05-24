<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard with sales analytics and metrics
     */
    public function dashboard()
    {
        // 1. Calculate Metrics
        $totalSales = Order::where('status', 'paid')->sum('total');
        $totalOrders = Order::count();
        $lowStockProducts = Product::where('stock', '<', 10)->count();
        
        $averageTicket = $totalOrders > 0 
            ? $totalSales / Order::where('status', 'paid')->count() 
            : 0;

        // 2. Fetch Recent Transactions and Products
        $recentOrders = Order::latest()->take(6)->get();
        $products = Product::with('category')->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'lowStockProducts',
            'averageTicket',
            'recentOrders',
            'products'
        ));
    }

    /**
     * List all orders in the system
     */
    public function orders()
    {
        $orders = Order::latest()->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    /**
     * List all products in the system
     */
    public function products()
    {
        $products = Product::with('category')->orderBy('name')->paginate(15);
        return view('admin.products', compact('products'));
    }
}
