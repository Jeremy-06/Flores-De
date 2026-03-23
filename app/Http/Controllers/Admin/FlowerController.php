<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlowerRequest;
use App\Http\Requests\UpdateFlowerRequest;
use App\Models\Category;
use App\Models\Flower;
use App\Models\FlowerImage;
use App\Imports\FlowersImport;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
class FlowerController extends Controller
{
    public function index(Request $request): View
    {
        $flowers = Flower::withTrashed()
            ->with('category', 'images')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.flowers.index', compact('flowers'));
    }
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.flowers.create', compact('categories'));
    }
    public function store(StoreFlowerRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $slug = Str::slug($validated['name']);
        $count = Flower::withTrashed()->where('slug', 'like', $slug . '%')->count();
        $validated['slug'] = $count ? $slug . '-' . ($count + 1) : $slug;

        $validated['available'] = $request->has('available');
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('flowers', 'public');
        }
        $flower = Flower::create($validated);
        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('flowers/gallery', 'public');
                $flower->images()->create(['image_path' => $path]);
            }
        }
        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower added!');
    }
    public function edit(Flower $flower): View
    {
        $categories = Category::all();
        $flower->load('images');
        return view('admin.flowers.edit', compact('flower', 'categories'));
    }
    public function update(UpdateFlowerRequest $request, Flower $flower): RedirectResponse
    {
        $validated = $request->validated();
        $slug = Str::slug($validated['name']);
        $count = Flower::withTrashed()->where('slug', 'like', $slug . '%')->count();
        $validated['slug'] = $count ? $slug . '-' . ($count + 1) : $slug;
        $validated['available'] = $request->has('available');
        if ($request->hasFile('image')) {
            if ($flower->image) {
                Storage::disk('public')->delete($flower->image);
            }
            $validated['image'] = $request->file('image')->store('flowers', 'public');
        }
        $flower->update($validated);
        // Handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('flowers/gallery', 'public');
                $flower->images()->create(['image_path' => $path]);
            }
        }
        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower updated!');
    }
    public function destroy(Flower $flower): RedirectResponse
    {
        $flower->delete();
        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower deleted (soft).');
    }
    public function restore($id): RedirectResponse
    {
        Flower::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flower restored!');
    }
    public function destroyImage(FlowerImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return redirect()->back()->with('success', 'Image removed.');
    }
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        Excel::import(new FlowersImport, $request->file('file'));
        return redirect()->route('admin.flowers.index')
            ->with('success', 'Flowers imported from Excel!');
    }
}