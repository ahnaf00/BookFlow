<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();

        return view('', ['subCategories' => $subCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
        ]);

        if($validation) {
          return response()->json([
            'message' => 'Oops! Invalid credentials.'
          ]);
        }

        $subCategories = SubCategory::create($request->all());

        return response()->json([
            'message' => 'Sub categories were created successfully',
            'subCategories' => $subCategories
        ], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subCategory = SubCategory::with('category')->findOrFail($id);

        return view('', ['subCategory' => $subCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = SubCategory::find($id);

        return view('', ['subCategory' => $subCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $subCategory->update($request->all());

        return response()->json([
            'message' => 'Sub Category updated successfully',
            'subCategory' => $subCategory,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // delete sub categories
        SubCategory::destroy($id);

        return response()->back()->with('success', 'Category deleted successfully');
    }
}
