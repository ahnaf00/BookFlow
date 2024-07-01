<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryPage()
    {
        return view('pages.category-page');
    }

    public function CategoryList()
    {
        $categories = Category::with('subcategories')->get();
        return response()->json($categories);
    }

    public function CreateCategory(Request $request)
    {
        try
        {
            $category = Category::create([
                'name'          => $request->input('name'),
                'description'   => $request->input('description')
            ]);

            return ResponseHelper::Out('Category created successful', $category, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('Category creation failed', $exception->getMessage(), 401);
        }
    }

    public function UpdateCategory(Request $request)
    {
        try
        {
            $category_id = $request->id;
            $category = Category::where('id', $category_id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return ResponseHelper::Out("Category Updated", $category, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out("Category Update failed", $exception->getMessage(), 401);
        }
    }

    public function CategoryById(Request $request)
    {
        try
        {
            $category_id = $request->id;
            $category = Category::where('id', $category_id)->with('subcategories')->first();

            return ResponseHelper::Out("success", $category, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out("Request failed", $exception->getMessage(), 401);
        }
    }

    public function DeleteCategory(Request $request)
    {
        try
        {
            $category_id = $request->id;
            $category = Category::with('subcategories')->findOrFail($category_id);

            foreach ($category->subcategories as $subcategory) {
                $subcategory->delete();
            }
            // Delete the category
            $category->delete();

            return ResponseHelper::Out("Category deleted successfull", $category, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out("Delete Request Failed", $exception->getMessage(), 401);
        }
    }
}
