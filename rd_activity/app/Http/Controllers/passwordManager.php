<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class passwordManager extends Controller
{
    function forgotPassword(){
        return view("password");
    }

    function forgotPasswordPost(Request $request){
        $request->validate([
            'email' => "required|email|exists:users",
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forgot-password", ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("Reset password");
        });

        return redirect()->to(route("forgot.password"))->with("success", "We have sent an email" );
    }

    function resetPassword($token){
        return view("new-password", compact('token'));
    }

    function resetPasswordPost(Request $request){
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required|string|confirmed",
            "confirmpassword" => "required"
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                "email" => $request->email,
                "token" => $request->token
            ])->first();
        
        if(!$updatePassword){
            return redirect()->to (route("reset.password"))->with("error", "Invalid");
        }

        User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table("password_reset_tokens")->where(["email"=> $request->email])->delete();

        return redirect()->to(route("login"))->with("success", "Password reset success");
    }
}
