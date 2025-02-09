<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

/**
 * Controller for managing user roles
 */
class RoleController extends Controller
{
    /**
     * Display a listing of all roles
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all roles from database
        $roles = Role::all();
        // Return view with roles data
        return view('role.index', compact('roles'));
    }
    
    /**
     * Store a new role in the database
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate role input data
        $request->validate([
            'role' => ['required','string','max:255','unique:'.Role::class],
        ]);

        // Create new role record
        Role::create($request->all());

        // Redirect to index page with success message
        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    /**
     * Update existing role data
     * 
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        // Validate role input data
        $request->validate([
            'role' => ['required','string','max:255','unique:'.Role::class],
        ]);

        // Update role name
        $role->role = $request->input('role');
        $role->save();

        // Redirect back with success message
        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Delete a role from database
     * 
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        // Delete the role record
        $role->delete();

        // Redirect back with success message
        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }
}
