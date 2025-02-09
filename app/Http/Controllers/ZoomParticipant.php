<?php

namespace App\Http\Controllers;

use App\Exports\HistoryExport;
use App\Exports\ParticipantExport;
use App\Models\Zoom;
use App\Models\UsersZoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ZoomParticipant extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get data
        $usersZoom = UsersZoom::all();
        $zooms = Zoom::with('participant')->latest()->paginate(6);
        return view('zoom.user.index', compact('usersZoom','zooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'zoom_id' => ['required', 'max:255', 'exists:zooms,id'],
            'documentation' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'link' => ['nullable','string']
        ]);

        $request->merge([
            'user_id' => Auth::user()->id, // Automatically set user_id
        ]);

        // Check if user already exists
        $user_id = Auth::user()->id;
        $zoom_id = $request->input('zoom_id');
        
        if (UsersZoom::where('zoom_id', $zoom_id)->where('user_id', $user_id)->exists()) 
        {
            return redirect()->back()->withErrors(['message' => 'You are already registered']);
        }
        else 
        {
            // Get the file
            $file = $request->file('documentation');

            // Generate a hashed file name
            $hashedName = hash('sha256', $file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            
            // Store the file with the hashed name
            $path = $file->storeAs('zooms/documentations', $hashedName, 'public'); 
            

        // Store data
        
        UsersZoom::create([
            'zoom_id' => $request->zoom_id,
            'user_id' => $request->user_id,
            'documentation' => $path,
        ]);

        if ($request->link) 
        {
            return Redirect::to($request->link);
        };

        // Redirect
        return redirect()->route('zoom-participant.index')->with('success', 'Participant created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UsersZoom $usersZoom)
    {
        // Delete documentation
        Storage::delete('public/zooms/documentations/'.$usersZoom->documentation);

        // Delete user
        $usersZoom->delete();

        // Redirect or response
        return redirect()->route('zoom-participant.index')->with('success', 'Participant deleted successfully.');
    }


    /**
     * Show zoom participant details.
     */
    public function details(UsersZoom $usersZoom)
    {
        // Get data
        $participants = UsersZoom::where('id', $usersZoom->id)
        ->with('user') // Eager load the user relationship
        ->get();
        $zoom = Zoom::find($usersZoom->zoom_id);
        return view('zoom.user.details', compact('participants', 'zoom'));
    }


    /**
     * Show zoom participant history.
     */
    public function history()
    {
        // Get data
        $histories = UsersZoom::where('user_id', Auth::user()->id)
        ->with(['zoom']) // Eager load user and zoom relationships
        ->get();
        return view('zoom.user.history', compact('histories'));
    }


    /**
     * Export zoom participant details.
     */
    public function export(UsersZoom $usersZoom)
    {
        // Get data
        $participants = UsersZoom::where('id', $usersZoom->id)
        ->with('user') // Eager load the user relationship
        ->get();
        $zoom = Zoom::find($usersZoom->zoom_id);
        return Excel::download(new ParticipantExport($participants), 'Zoom Participant '.$zoom->title.'.xlsx');
    }


    /**
     * Export zoom history details.
     */
    public function exportHistory()
    {
        // Get data
        $histories = UsersZoom::where('user_id', Auth::user()->id)
        ->with(['zoom']) // Eager load user and zoom relationships
        ->get();
        return Excel::download(new HistoryExport($histories), 'Zoom History '.Auth::user()->name.'.xlsx');
    }




}
