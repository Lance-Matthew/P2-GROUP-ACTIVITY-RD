<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Https\Controllers\Session;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    function register(){
        return view('register');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'))->with("success", "Login successful");
        }
        return redirect(route('login'))->with("error", "Invalid credentials");
    }

    function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required', 'confirmed',
            'confirmpassword' => 'required_with:password|same:password', 
        ]);
        
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if(!$user){
            return redirect(route('register'))->with("error", "Registration failed, try again");
        }
        return redirect(route('login'))->with("Success", "Registration successful");

    }

    function logout(){
        
        Auth::logout();
        return redirect(route('login'));
    }
}
