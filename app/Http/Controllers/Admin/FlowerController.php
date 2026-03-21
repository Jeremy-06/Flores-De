<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FlowerController extends Controller
{
    public function index(): View
    {
        $flowers = Flower::with('category')->latest()->paginate(15);
        return view('admin.flowers.index', compact('flowers'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.flowers.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'available' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['available'] = $request->has('available');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('flowers', 'public');
        }

        Flower::create($validated);

        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower added!');
    }

    public function edit(Flower $flower): View
    {
        $categories = Category::all();
        return view('admin.flowers.edit', compact('flower', 'categories'));
    }

    public function update(Request $request, Flower $flower): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'available' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['available'] = $request->has('available');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('flowers', 'public');
        }

        $flower->update($validated);

        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower updated!');
    }

    public function destroy(Flower $flower): RedirectResponse
    {
        $flower->delete();

        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower deleted successfully.');
    }

    public function restore($id)
    {
        Flower::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower restored successfully.');
    }
}