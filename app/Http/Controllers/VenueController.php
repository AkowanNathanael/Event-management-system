<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $venues = Venue::all();
        return view("admin.venue.index", [
            "venues" => $venues
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.venue.create_venue");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "city" => "required|string|max:255",
            "address" => "required|string|max:255",
            "capacity" => "required|integer|min:1",
            // "facilities" => "nullable|array",
            "phone" => "required|string|min:10|max:10",
            "email" => "required|email|max:255",
        ]);
        Venue::create($validated);
        // $venues = Venue::all();
        // return view("admin.venue.index", [
        //     "venues" => $venues,
        //     "success" => "Venue created successfully."
        // ]);
        return redirect("/admin/venue")->with(["message" => "venue created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        //
        return view("admin.venue.show",[
            "venue" => $venue,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        //
        return view("admin.venue.edit", [
            "venue" => $venue,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        //
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "city" => "required|string|max:255",
            "address" => "required|string|max:255",
            "capacity" => "required|integer|min:1",
            // "facilities" => "nullable|array",
            "phone" => "required|string|min:10|max:10",
            "email" => "required|email|max:255",
        ]);
        $venue->update($validated);
        $venues = Venue::all();
        return view("admin.venue.index", [
            "venues" => $venues,
            "success" => "Venue updated successfully."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        //

        $venue->delete();
        $venues = Venue::all();
        return view("admin.venue.index", [
            "venues" => $venues,
            "success" => "Venue deleted successfully."
        ]);
    }
}
