<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

/**
 * Controller for managing location data
 */
class LocationController extends Controller
{
    /**
     * Display a listing of all locations
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all location data
        $locations = Location::all();
        
        // Return view with location data
        return view('location.index', compact('locations'));
    }

    /**
     * Store a new location in the database
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate location input data
        $request->validate([
            'location' => ['required','string','max:255','unique:'.Location::class],
        ]);

        // Save new location data
        Location::create($request->all());

        // Redirect to index page with success message
        return redirect()->route('location.index')->with('success', 'Location created successfully.');
    }

    /**
     * Update existing location data
     * 
     * @param Request $request
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Location $location)
    {
        // Validate location input data
        $request->validate([
            'location' => ['required','string','max:255','unique:'.Location::class],
        ]);

        // Update location data
        $location->location = $request->input('location');
        $location->save();

        // Redirect with success message
        return redirect()->route('location.index')->with('success', 'Location updated successfully!');
    }

    /**
     * Delete location data
     * 
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Location $location)
    {
        // Delete location data
        $location->delete();

        // Redirect with success message
        return redirect()->route('location.index')->with('success', 'Location deleted successfully!');
    }
}
