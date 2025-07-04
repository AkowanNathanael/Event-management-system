<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePodcastRequest;
use App\Http\Requests\UpdatePodcastRequest;
use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $podcasts = Podcast::latest()->get();
        // dd($podcasts);
        return view("admin.podcast.index", ["podcasts" => $podcasts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // dd($categories);
        return view("admin.podcast.create_podcast", ["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->file("image")->store("podcasr", "public"));
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "audio" => ["required", "max:10480"],
            "category_id" => ["required"]
            // "user_id" => ["required"]
        ]);
        $validated["user_id"] = Auth::user()->id;
        // dd($validated);

        if ($request->hasFile("audio")) {
            //  dd($validated);
            $validated["audio"] = Storage::disk("public")->putFile("podcast", $request->file("audio"));
        }
        //   dd("ok");
        Podcast::create($validated);
        return redirect("/admin/podcast")->with(["message" => "podcast created successfully"]);
        // dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        //
        // dd($podcast);
        return view("admin.podcast.show", ["podcast" => $podcast]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Podcast $podcast)
    {
        $categories = Category::all();
        // dd($post);
        return view("admin.podcast.edit", ["podcast" => $podcast, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Podcast $podcast)
    {
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "audio" => ["required", "max:10480"],
            "category_id" => ["required"]
            // "user_id" => ["required"]
        ]);
        $validated["user_id"] = Auth::user()->id;
        if ($request->hasFile("audio")) {
            //  dd($validated);
            if ($podcast->image) {
                Storage::disk("public")->delete($podcast->audio);
            }
            $validated["audio"] = Storage::disk("public")->putFile("podcast", $request->file("audio"));
        }
        $podcast->update($validated);
        return redirect("/admin/podcast")->with(["update" => "podcast updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        //
        $podcast->delete();
        if ($podcast->audio) {
            Storage::disk("public")->delete($podcast->audio);
        }
        return redirect("/admin/podcast")->with(["delete" => "podcast deleted"]);
        // dd($post);
    }
}
