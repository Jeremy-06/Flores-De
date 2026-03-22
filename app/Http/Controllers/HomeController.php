<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all();

        // MP8: Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $flowers = Flower::available()
                ->with('category')
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhereHas('category', fn($c) => $c->where('name', 'like', "%{$search}%"));
                })
                ->paginate(12)
                ->withQueryString();

            return view('home', compact('categories', 'flowers', 'search'));
        }

        $featuredFlowers = Flower::available()
            ->with('category')
            ->inRandomOrder()
            ->take(8)
            ->get();

        $latestFlowers = Flower::available()
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('categories', 'featuredFlowers', 'latestFlowers'));
    }
}
