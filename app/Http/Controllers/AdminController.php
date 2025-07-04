<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.admin.index',['admins'=> User::where('isadmin',1)->get()]);
    }    
    public function create()
    {
        return view('admin..admin.create_admin');
    }                   
    public function store(Request $request)
    {
        // Validate and store the data
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        $validated['password'] = bcrypt("password");
        $validated['isadmin'] = 1;
        User::create($validated);
        return redirect('/admin/admin')->with('success', 'Admin created successfully.');
    }   

    public function edit(User $admin)
    { 
        return view('admin.admin.edit', ['admin'=>$admin]);
    } 
    public function show(User $admin)
    {
        return view('admin.admin.show', ['admin'=>$admin]);
    }
    public function update(User $admin, Request $request)
    {
        // Validate and update the data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ]);
        // dd($validated);
        $admin->update($validated);
        return redirect('/admin/admin')->with(["update" => "admin updated"]);;
    }
  
    public function destroy(User $user)
    {
        // Validate and delete the data
        $user->delete();
        return back()->with('success', 'Admin deleted successfully.');
    }
  
}
