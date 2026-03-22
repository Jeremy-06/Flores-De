<?php
namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
class ReviewController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'flower_id' => 'required|exists:flowers,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        // Check if user bought this flower (has a delivered order containing it)
        $hasBought = auth()->user()->orders()
            ->where('status', 'delivered')
            ->whereHas('items', function ($q) use ($request) {
                $q->where('flower_id', $request->flower_id);
            })->exists();
        if (!$hasBought) {
            return back()->with('error', 'You can only review products you have purchased.');
        }
        // Check if already reviewed
        $existing = Review::where('user_id', auth()->id())
            ->where('flower_id', $request->flower_id)->first();
        if ($existing) {
            return back()->with('error', 'You have already reviewed this product.');
        }
        Review::create([
            'user_id' => auth()->id(),
            'flower_id' => $request->flower_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return back()->with('success', 'Review posted!');
    }
    public function update(Request $request, Review $review): RedirectResponse
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        $review->update($request->only('rating', 'comment'));
        return back()->with('success', 'Review updated!');
    }
}