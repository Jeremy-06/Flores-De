<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => 'required|in:customer,admin',
            'status' => 'required|in:active,inactive',
        ]);
        $user->update($validated);
        return redirect()->route('admin.users.index')
            ->with('success', 'User updated!');
    }
}