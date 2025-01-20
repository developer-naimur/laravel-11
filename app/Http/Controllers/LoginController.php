<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(UserLoginRequest $request){
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
        }
        // Create the token
        $token = $user->createToken('sdfw3r')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
}
