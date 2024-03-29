<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 200,
            'products' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                'product' => $product
            ], 200);
        }else{
            return response()->json([
                'message' => "No Such product Found!"
            ], 404);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'slug' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:491',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }else{
            $product = Product::create([
                'user_id' => $request->user_id,
                'slug' => $request->slug,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id'=> $request->category_id
            ]);

            if($product){
                return response()->json([
                    'message' => "Product Created Successfully",
                    'product' => $product
                ], 200);
            }else{
                return response()->json([
                    'message' => "Some thing went wrong!"
                ], 500);
            }
        }
    }


    public function edit($id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                'product' => $product
            ], 200);
        }else{
            return response()->json([
                'message' => "No Such product Found!"
            ], 404);
        }
    }


    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'slug' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:491',
            'price' =>'required|numeric',
            'category_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }else{
            $product = Product::find($id);

            if($product){

                $product->update([
                    'user_id' => $request->user_id,
                    'slug' => $request->slug,
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category_id'=> $request->category_id
                ]);

                return response()->json([
                    'message' => "Product Updated Successfully",
                    'product' => $product
                ], 200);
            }else{
                return response()->json([
                    'message' => "No such product fond!"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'message' => "Product Deleted Successfully",
            ], 200);
        }else{
            return response()->json([
                'message' => "No such product Found!"
            ], 404);
        }
    }

}


