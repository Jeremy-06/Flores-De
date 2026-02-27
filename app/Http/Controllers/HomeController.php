<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Flower;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

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
