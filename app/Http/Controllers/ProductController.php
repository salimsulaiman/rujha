<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categorySlug = $request->input('category');
        $sort = $request->input('sort', 'newest');

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($categorySlug, function ($query) use ($categorySlug) {
                $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->when($sort === 'popular', function ($query) {
                $query->withCount('orderItems')->orderByDesc('order_items_count');
            }, function ($query) {
                $query->latest(); // default: terbaru
            })
            ->paginate(8)
            ->withQueryString();

        $popularProducts = Product::with('category')
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit(4)
            ->get();

        $categories = Category::get();

        return view('pages.product.products', compact('products', 'popularProducts', 'search', 'categories', 'categorySlug', 'sort'));
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
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
    public function show($slug)
    {
        $product = Product::with('variants.sizes', 'variants.images', 'category')->where('slug', $slug)->firstOrFail();

        return view('pages.product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
