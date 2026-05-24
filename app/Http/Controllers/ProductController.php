<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the e-commerce home page
     */
    public function home()
    {
        $categories = Category::all();
        $featuredProducts = Product::where('is_featured', true)->take(4)->get();
        $newArrivals = Product::latest()->take(4)->get();

        return view('home', compact('categories', 'featuredProducts', 'newArrivals'));
    }

    /**
     * Display the product catalog with filtering options
     */
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        // Filter by Category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by Search Query
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by Skin Type
        if ($request->filled('skin_type')) {
            $query->where('skin_type', 'like', '%' . $request->skin_type . '%');
        }

        // Filter by Price Range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sorting
        $sort = $request->get('sort', 'default');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('is_featured', 'desc')->orderBy('name', 'asc');
        }

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::all();
        
        // Define standard skin types for filter dropdown
        $skinTypes = ['Sensible', 'Seca', 'Grasa', 'Mixta', 'Todo tipo de piel'];

        return view('catalog', compact('products', 'categories', 'skinTypes'));
    }

    /**
     * Display the single product detail page
     */
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        
        // Get related products (same category, excluding current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('show', compact('product', 'relatedProducts'));
    }
}
