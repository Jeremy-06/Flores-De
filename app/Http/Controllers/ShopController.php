<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $query = Flower::available()->with('category');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'name' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $flowers = $query->paginate(12);
        $categories = Category::all();

        return view('shop.index', compact('flowers', 'categories'));
    }

    public function show(string $slug): View
    {
        $flower = Flower::where('slug', $slug)
            ->available()
            ->with('category', 'images')  // add 'images' here
            ->firstOrFail();


        $relatedFlowers = Flower::available()
            ->where('category_id', $flower->category_id)
            ->where('id', '!=', $flower->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('flower', 'relatedFlowers'));
    }

    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $flowers = Flower::available()
            ->where('category_id', $category->id)
            ->paginate(12);

        $categories = Category::all();

        return view('shop.index', compact('flowers', 'categories', 'category'));
    }
}
