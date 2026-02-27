<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = \Cart::getContent();
        $total = \Cart::getTotal();

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'flower_id' => 'required|exists:flowers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $flower = Flower::findOrFail($request->flower_id);

        \Cart::add([
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $flower->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $flower->image,
                'slug' => $flower->slug,
            ],
        ]);

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity,
            ],
        ]);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(int $id): RedirectResponse
    {
        \Cart::remove($id);

        return redirect()->back()->with('success', 'Item removed!');
    }

    public function clear(): RedirectResponse
    {
        \Cart::clear();

        return redirect()->back()->with('success', 'Cart cleared!');
    }
}
