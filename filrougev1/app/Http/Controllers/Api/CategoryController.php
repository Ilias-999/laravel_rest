<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 200,
            'categories' => $categories
        ], 200);
    }

    public function show($id)
    {
        $categories = Category::find($id);
        if($categories){
            return response()->json([
                'category' => $categories
            ], 200);
        }else{
            return response()->json([
                'message' => "No such category Found!"
            ], 404);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:491',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }else{
            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if($category){
                return response()->json([
                    'message' => "Category Created Successfully",
                    'category' => $category
                ], 200);
            }else{
                return response()->json([
                    'message' => "Some thing went wrong!"
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return response()->json([
                'message' => "Category Deleted Successfully",
            ], 200);
        }else{
            return response()->json([
                'message' => "No such category Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if($category){
            return response()->json([
                'category' => $category
            ], 200);
        }else{
            return response()->json([
                'message' => "No Such category Found!"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:491'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }else{
            $category = Category::find($id);

            if($category){
                $category->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

                return response()->json([
                    'message' => "Product Updated Successfully",
                    'category' => $category
                ], 200);
            }else{
                return response()->json([
                    'message' => "No such product fond!"
                ], 404);
            }
        }
    }


}
