<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
   
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response('Login invalid', 503);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user,
            "access_token" => 'Bearer ' . $user->createToken('Personal Access Token', ['admin'])->plainTextToken,
        ]);
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();
        // if(auth()->user()->tokens()){
        //     return 'token has';
        // }else{
        //     return 'no token';
        // }

        return response()->json([
            'status' => 'success',
        ]);
    }
}
