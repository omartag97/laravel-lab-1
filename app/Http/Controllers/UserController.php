<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;



class UserController extends Controller
{
    public function register()
    {
        return view('registeration');
    }

    public function store(Request $request)
    {

            // saving data into users table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken(time())->plainTextToken;
            // return JSON API (User access token)
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
                'token' => $token,
            ]);
        }


    public function login()
    {
        return view('login');
    }

    public function handlelogin(Request $request)
    {

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        } else {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken(time())->plainTextToken;
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('user.login');
    }
}
