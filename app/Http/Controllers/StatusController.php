<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Controller for managing user status
 */
class StatusController extends Controller
{
    /**
     * Display a listing of all users except admins
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('status', '!=', 'admin')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Update user status in the database
     * 
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Validate status input data
        $request->validate([
            'status' => ['required','string','max:255'],
        ]);

        // Update user status
        $user->status = $request->input('status');
        $user->save();

        // Redirect to index page with success message
        return redirect()->route('status.index')->with('success', 'User updated successfully.');
    }

}
