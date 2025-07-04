<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest()->get();
        // dd($categories);
        return view("admin.service.index", ["services" => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // dd($categories);
        return view("admin.service.create_service", ["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->file("image")->store("service", "public"));
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "image" => ["nullable", "max:1048"]
        ]);
        $validated["user_id"] = Auth::user()->id;
        // dd($validated);

        if ($request->hasFile("image")) {
            //  dd($validated);
            $validated["image"] = Storage::disk("public")->putFile("service", $request->file("image"));
        }
        //   dd("ok");
        Service::create($validated);
        return redirect("/admin/service")->with(["message" => "service created successfully"]);
        // dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
        // dd($service);
        return view("admin.service.show", ["service" => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $categories = Category::all();
        // dd($service);
        return view("admin.service.edit", ["service" => $service, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "image" => ["nullable", "max:1048"]
        ]);
        $validated["user_id"] = Auth::user()->id;
        if ($request->hasFile("image")) {
            //  dd($validated);
            if ($service->image) {
                Storage::disk("public")->delete($service->image);
            }
            $validated["image"] = Storage::disk("public")->putFile("service", $request->file("image"));
        }
        $service->update($validated);
        return redirect("/admin/service")->with(["update" => "service updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
        $service->delete();
        if ($service->image) {
            Storage::disk("public")->delete($service->image);
        }
        return redirect("/admin/service")->with(["delete" => "service deleted"]);
        // dd($service);
    }
}
