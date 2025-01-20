<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->created_at = now();
        $role->updated_at = now();
        $role->save();

        // Attach permissions after saving the role
        $role->permissions()->attach([1, 2]);

        return response()->json(['message' => 'Data has been saved'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ], [
            'name.unique' => 'The name has already been taken.',
        ]);

        $role = Role::find($id);


        // Find the role
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->name = $request->name;
        $role->updated_at = now();
        $role->save();

        // Attach permissions after saving the role
        $role->permissions()->sync([1, 3]);

        return response()->json(['message' => 'Data has been saved'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Check if the record exists
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        // Delete the record
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
