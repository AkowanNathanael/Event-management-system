<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        // dd($categories);
        return view("admin.post.index", ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        // dd($categories);
        return view("admin.post.create_post",["categories"=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // dd($request->file("image")->store("post", "public"));
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "image" => ["nullable","max:1048"],
            "category_id" => ["required"]
            // "user_id" => ["required"]
        ]);
         $validated["user_id"]= Auth::user()->id;
        // dd($validated);

        if($request->hasFile("image")){
            //  dd($validated);
            $validated["image"] = Storage::disk("public")->putFile("post", $request->file("image"));
        }
//   dd("ok");
        Post::create($validated);
        return redirect("/admin/post")->with(["message" => "post created successfully"]);
        // dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        // dd($post->image);
        return view("admin.post.show", ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        // dd($post);
        return view("admin.post.edit", ["post" => $post, "categories"=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "image" => ["nullable", "max:1048"],
            "category_id" => ["required"]
            // "user_id" => ["required"]
        ]);
        $validated["user_id"] = Auth::user()->id;
        if ($request->hasFile("image")) {
            //  dd($validated);
            if($post->image){
                Storage::disk("public")->delete($post->image);
            }
            $validated["image"] = Storage::disk("public")->putFile("post", $request->file("image"));
        }
        $post->update($validated);
        return redirect("/admin/post")->with(["update" => "post updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        if($post->image){
            Storage::disk("public")->delete($post->image);
        }
        return redirect("/admin/post")->with(["delete" => "post deleted"]);
        // dd($post);
    }
}
