<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $artists = Artist::all();
        return view("admin.artist.index",[
            "artists" => $artists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.artist.create_artist");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url',
            'social_media' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile("image")) {
            $validatedData['image'] = $request->file('image')->store('artists', 'public');
            // lidated["image"] = Storage::disk("public")->putFile("artists", $request->file("image"));
        } else {
            $validatedData['image'] = null; // Set to null if no image is uploaded
        }
         Artist::create($validatedData);
        return redirect("/admin/artist")->with("success", "Artist created successfully.");


    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        //
        return view("admin.artist.show", [
            "artist" => $artist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        //
        return view("admin.artist.edit", [
            "artist" => $artist
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url',
            'social_media' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile("image")) {
            $validatedData['image'] = $request->file('image')->store('artists', 'public');
            // $validatedData["image"] = Storage::disk("public")->putFile("artists", $request->file("image")));
            if ($artist->image) {
                // Delete the old image if it exists
                Storage::disk('public')->delete($artist->image);
            }
        }

        $artist->update($validatedData);
        return redirect("admin.artist.index")->with("success", "Artist updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        //
    }
}
