<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

/**
 * Controller for managing user profiles
 */
class ProfileController extends Controller
{
    /**
     * Display the user's profile edit form.
     * 
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        $roles = Role::latest()->get();
        return view('profile.edit', [
            'user' => $request->user(), 
            'roles' => $roles,
        ]);
    }

    /**
     * Update the user's profile information including profile image.
     * 
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        // Reset email verification if email is changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle profile image upload if provided
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            // Generate a hashed file name for security
            $hashedName = hash('sha256', $file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            
            // Store the file in public storage with hashed name
            $path = $file->storeAs('profiles/profile_images', $hashedName, 'public'); 

            $image = User::find(Auth::user()->id)->profile_image;
            // Remove old profile image if exists and not default
            if ($image && $image !== 'public/profiles/profile_images/profile.png') {
                Storage::disk('public')->exists($image);
                Storage::disk('public')->delete($image);
            }

            // Update user profile with new image path
            $user->profile_image = $path;
        }
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account and associated data.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $image = User::find(Auth::user()->id)->profile_image;

        Auth::logout();

        // Remove user's profile image
        Storage::disk('public')->delete($image);

        // Delete user account
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
