<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::latest()->get();
        // dd($categories);
        return view("admin.resource.index", ["resources" => $resources]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.resource.create_resource");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->file("file")->store("post", "public"));
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "file" => ["required", "file", "max:25480"],
            "url" => ["url", "nullable"],
            "type" => ["required"],
        ]);

        // dd($request->file("file")->getMimeType());
        // dd(str_contains($request->file("file")->getMimeType(), "image")); 


        if ($request->hasFile("file")) {
            //  dd($validated);
            if(str_contains($request->file("file")->getMimeType(),"image")){
                // dd("image");
                $validated["file"] = Storage::disk("public")->putFile("resource/image", $request->file("file"));
            }elseif(str_contains($request->file("file")->getMimeType(), "application")){
                // dd("app");
                $validated["file"] = Storage::disk("public")->putFile("resource/doc", $request->file("file"));
            } elseif (str_contains($request->file("file")->getMimeType(), "video")){
                // dd("video");
                $validated["file"] = Storage::disk("public")->putFile("resource/video", $request->file("file"));
            }elseif(str_contains($request->file("file")->getMimeType(), "text")){
                $validated["file"] = Storage::disk("public")->putFile("resource/text", $request->file("file"));
            }else{
                return back()->with(["file"=>"file format not accepted"]);
            }
            // dd("none");

            // $validated["file"] = Storage::disk("public")->putFile("resource", $request->file("file"));
            
        }
        Resource::create($validated);
        return redirect("/admin/resource")->with(["message" => "resource created successfully"]);
        // dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        //
        // dd($post);
        return view("admin.resource.show", ["resource" => $resource]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {

        return view("admin.resource.edit", ["resource" => $resource]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        // dd($request->all());
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "file" => ["required", "file", "max:25480"],
            "url" => ["url", "nullable"],
            "type" => ["required"],
        ]);
        dd("ok");
        if ($request->hasFile("file")) {
            //  dd($validated);
            if ($resource->file) {
                Storage::disk("public")->delete($resource->file);
            }
            if (str_contains($request->file("file")->getMimeType(), "image")) {
                // dd("image");
                $validated["file"] = Storage::disk("public")->putFile("resource/image", $request->file("file"));
            } elseif (str_contains($request->file("file")->getMimeType(), "application")) {
                // dd("app");
                $validated["file"] = Storage::disk("public")->putFile("resource/doc", $request->file("file"));
            } elseif (str_contains($request->file("file")->getMimeType(), "video")) {
                // dd("video");
                $validated["file"] = Storage::disk("public")->putFile("resource/video", $request->file("file"));
            } elseif (str_contains($request->file("file")->getMimeType(), "text")) {
                $validated["file"] = Storage::disk("public")->putFile("resource/text", $request->file("file"));
            } else {
                return back()->with(["file" => "file format not accepted"]);
            }
        }
        $resource->update($validated);
        return redirect("/admin/resource")->with(["update" => "resource updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        //
        $resource->delete();
        if ($resource->file) {
            Storage::disk("public")->delete($resource->file);
        }
        return redirect("/admin/resource")->with(["delete" => "resource deleted"]);
    }
}
