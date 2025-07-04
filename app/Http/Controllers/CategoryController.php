<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::latest()->get();
        // dd($categories);
        return view("admin.category.index",["categories"=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view("admin.category.create_category");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            "name"=>["required"],
            "description"=>["nullable"]
        ]);

        Category::create($validated);
        return redirect("/admin/category")->with(["message"=>"category created successfully"]);
        // dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        // dd($category);
        return view("admin.category.show",["category"=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        // dd($category);
        return view("admin.category.edit",["category"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        // dd($category);
        $validated = $request->validate([
            "name" => ["required"],
            "description" => ["nullable"]
        ]);
        $category->update($validated);
        return redirect("/admin/category")->with(["update" => "category update"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return redirect("/admin/category")->with(["delete"=>"category deleted"]);
        // dd($category);
    }
}
