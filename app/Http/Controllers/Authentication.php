<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Authentication extends Controller
{
    //
    public function register(Request $request){
        $validated=$request->validate([
            "name"=>["required","string","min:3"],
            "email"=>["required","email", "unique:users,email"],
            "password"=>["required", "confirmed","min:4"],
            "businessname"=>["required","string"],
        ]);
        $validated['isadmin']=0;
        // dd($validated);
        $user=User::create($validated);
        Auth::login($user);
        return redirect("/admin/dashboard");
    }

    public function login(Request $request){
        $validatedfields=$request->validate([
            "email"=>[ "required","email"],
            "password"=>["required"]
        ]);
        // dd($request->remember);
        if(Auth::attempt($validatedfields, $request->remember)){
            // dd("ok");
            return redirect()->intended("/admin/dashboard");
        }else{
            return back()->withErrors(["email"=>"user entered wrong credentials"]);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/login");

    }
    public function  changepassword(Request $request){
        $validated= $request->validate([
            "oldpassword"=>["required"],
            "newpassword"=>["required","confirmed",'min:6']
        ]);
        // dd(Auth::user()->password);
        if(!Hash::check($validated["oldpassword"], Auth::user()->password)){
            return  back()->with(["password_error"=>"invalid authentication"]);
        }
        Auth::user()->password=$validated["newpassword"];
        $user = Auth::user();
        $user->save();
        return back()->with(["message"=>"new password updated"]);
    }
    public function uploadprofilepicture(Request $request){
        $validated=$request->validate(["image"=>["file","max:1048"]]);
        if(!$request->hasFile("image")){
            return back()->with(["message"=>"file not chosen"]);
        }
        // dd($request->file("image"));
        $user = Auth::user();
        $user->image = Storage::disk("public")->putFile('profile', $request->file('image'));
        $user->save();
        return back()->with(["message" => "profile picture updated"]);
        // Authh::user()->image=        dd($validated);
    }
}
