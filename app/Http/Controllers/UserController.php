<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Hash;

class UserController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $user = User::all();
        return response()->json([$user], 200);
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
    public function store(UserStoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->created_at = now();
        $user->updated_at = now();

        $user->save();

        $user->roles()->attach([2]);

        return response()->json(['message' => 'Data has been saved'], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(['data' => $user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->updated_at = now();

        $user->save();

        $user->roles()->sync([2]);

        return response()->json(['message' => 'Data has been updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
    }

}
