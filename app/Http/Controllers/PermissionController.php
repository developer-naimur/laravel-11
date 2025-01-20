<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
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
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->created_at = now();
        $permission->updated_at = now();
        $permission->save();

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ], [
            'name.unique' => 'The name has already been taken.',
        ]);

        $permission = Permission::find($id);

        // Find the permission
        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }


        $permission->name = $request->name;
        $permission->updated_at = now();
        $permission->save();

        return response()->json(['message' => 'Data has been saved'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Check if the record exists
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        // Delete the record
        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully'], 200);
    }

}
