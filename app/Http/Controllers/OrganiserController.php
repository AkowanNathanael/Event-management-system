<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganiserRequest;
use App\Http\Requests\UpdateOrganiserRequest;
use App\Models\Organiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganiserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $organisers=Organiser::latest()->get();
        return view('admin.organiser.index',["organisers"=>$organisers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.organiser.create_organiser");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile("image")) {
            $validatedData['image'] = $request->file('image')->store('organiser', 'public');
            // lidated["image"] = Storage::disk("public")->putFile("artists", $request->file("image"));
        } else {
            $validatedData['image'] = null; // Set to null if no image is uploaded
        }
        Organiser::create($validatedData);
        return redirect("/admin/organiser")->with("success", "organiser created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Organiser $organiser)
    {
        //
        return view("admin.organiser.show",["organiser"=>$organiser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organiser $organiser)
    {
        //
        return view("admin.organiser.edit",["organiser"=>$organiser]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organiser $organiser)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile("image")) {
            if ($organiser->image) {
                // Delete the old image if it exists
                Storage::disk('public')->delete($organiser->image);
            }
            $validatedData['image'] = $request->file('image')->store('organiser', 'public');
            // $validatedData["image"] = Storage::disk("public")->putFile("artists", $request->file("image")));
        }

        $organiser->update($validatedData);
        return redirect("/admin/organiser")->with("success", "organiser updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organiser $organiser)
    {
        //
        // dd($organiser);
        // dd(request()->route()->getName());
        if ($organiser->image) {
            // Delete the old image if it exists
            Storage::disk('public')->delete($organiser->image);
        }
        // $item=$organiser->delete();
        // dd($item);
        $organiser->delete();
        return redirect("/admin/organiser")->with("success", "organiser deleted successfully.");
    }
}
