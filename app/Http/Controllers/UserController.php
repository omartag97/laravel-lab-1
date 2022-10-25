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

        // saving the value in varaible (Password)
        $password = $request->input('password');

        // creating new object from model User
        $user = new User();


        // Storing name , email and password into the database
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Encryption (Hashing the password)
        $user->password = Hash::make($password);

        // Creating Random acces_token
        // $user->acces_token = str::random(64);

        // saving the data into the database
        $user->save();

        return redirect()->route('post.index');
        // return JSON API (User access token)
        // return response()->json([
        //     'acces_token' => $user->acces_token,
        //     'name' => $user->name,
        //     'email' => $user->email
        // ]);
    }

    public function login()
    {
        return view('login');
    }

    public function handlelogin(Request $request)
    {
        // Get user Credintial (Email & Password)
        $cred = array('email' => $request->email, 'password' => $request->password);

        // Validation (if the Email & the Password is existing)
        if (Auth::attempt($cred)) {
            // checking if the current user has access_token or not
            // if (!isset(Auth::user()->access_token)) {
            //     Auth::user()->access_token = str::random(64);
            //     Auth::user()->save;
            // }
            // return [(Auth::user) >> the current user] name , email and access token
            // return response()->json([
            //     'acces_token' => Auth::user()->acces_token,
            //     'email' => Auth::user()->email,
            //     'name' => Auth::user()->name
            // ]);

            return redirect()->route('post.index');
        } else {
            echo 'Not Valid Credintial!';
            return redirect()->route('user.register');
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
