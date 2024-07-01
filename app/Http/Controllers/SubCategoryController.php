<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function SubCategoryPage()
    {
        return view('pages.subcategory-page');
    }
    public function SubCategoryList()
    {
        try
        {
            $subcategories = SubCategory::with('category')->get();

            return ResponseHelper::Out('Success', $subcategories, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('Failed', $exception->getMessage(), 401);
        }
    }

    public function SubCategoryById(Request $request)
    {
        try
        {
            $subcategory_id = $request->id;
            $subcategory = SubCategory::where('id', $subcategory_id)->first();

            return ResponseHelper::Out('Success', $subcategory, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('failed', $exception->getMessage(), 401);
        }
    }

    public function CreateSubCategory(Request $request)
    {
        try
        {
            $validatedData = $request->validate([
                'category_id'   => 'required|exists:categories,id',
                'name'          => 'required|string|max:255',
                'description'   => 'nullable|string',
            ]);

            // Create the subcategory
            $subcategory = Subcategory::create([
                'category_id'   => $validatedData['category_id'],
                'name'          => $validatedData['name'],
                'description'   => $validatedData['description'],
            ]);

            return ResponseHelper::Out('Sub category created successfully', $subcategory, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out("Subcategory creation failed", $exception->getMessage(), 401);
        }
    }

    public function UpdateSubCategory(Request $request)
    {
        try
        {
            $subcategory_id = $request->id;

            $subcategory = SubCategory::findOrFail($subcategory_id);

            $subcategory->update([
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'category_id'   => $request->input('category_id'),
            ]);

            return ResponseHelper::Out('Subcategory updated successfully', $subcategory, 200);
        }
        catch (Exception $exception)
        {
            return ResponseHelper::Out('Subcategory update failed',$exception->getMessage(), 401);
        }

    }

    public function DeleteSubCategory(Request $request)
    {
        try
        {
            $subcategory_id = $request->id;
            $subcategory = SubCategory::where('id', $subcategory_id)->delete();

            return ResponseHelper::Out("Subcatehory Deleted Successfull", $subcategory, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out("Delete request failed", $exception->getMessage(), 401);
        }
    }
}
