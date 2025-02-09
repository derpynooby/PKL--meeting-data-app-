<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Zoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoomController extends Controller
{
    /**
     * Display a listing of zoom meetings
     */
    public function index()
    {
        $locations = Location::all();
        $zooms = Zoom::with('participant')->latest()->paginate(6);
        return view('zoom.admin.index', compact('zooms','locations'));
    }

    /**
     * Store a new zoom meeting in storage
     */
    public function store(Request $request)
    {
        //validate input data
        $request->validate([
            'title' => ['required', 'string', 'max:70'],   
            'location_id' => ['required', 'max:255', 'exists:locations,id'], 
            'start' => ['required', 'date_format:H:i'],  
            'end' => ['required', 'date_format:H:i'],  
            'datetime' => ['required', 'date'],   
            'link' => ['nullable', 'string'],
            'description' => ['nullable', 'string', 'max:200'],   
        ]);

        $request->merge([
            'created_by' => Auth::user()->name, // Automatically fill created_by field
        ]);

        //create new zoom meeting record
        Zoom::create($request->all());

        //redirect with success message
        return redirect()->route('zoom.index')->with('success', 'Zoom created successfully.');
    }

    /**
     * Update an existing zoom meeting in storage
     */
    public function update(Request $request, Zoom $zoom)
    {
        //validate input data
        $request->validate([
            'title' => ['required', 'string', 'max:70'],   
            'location_id' => ['required', 'max:255', 'exists:locations,id'],   
            'start' => ['required', 'date_format:H:i'],  
            'end' => ['required', 'date_format:H:i'], 
            'datetime' => ['required', 'date'],   
            'link' => ['required', 'string'],
            'description' => ['required', 'string', 'max:200'],   
        ]);

        // Update zoom meeting details
        $zoom->title = $request->input('title');
        $zoom->location_id = $request->input('location_id');
        $zoom->start = $request->input('start');
        $zoom->end = $request->input('end');
        $zoom->datetime = $request->input('datetime');
        $zoom->link = $request->input('link');
        $zoom->description = $request->input('description');
        $zoom->save();

        // Redirect with success message
        return redirect()->route('zoom.index')->with('success', 'Zoom updated successfully.');
    }

    /**
     * Delete a zoom meeting from storage
     */
    public function destroy(Zoom $zoom)
    {
        //Delete zoom meeting
        $zoom->delete();

        //Redirect with success message
        return redirect()->route('zoom.index')->with('success', 'Zoom deleted successfully.');
    }
}
