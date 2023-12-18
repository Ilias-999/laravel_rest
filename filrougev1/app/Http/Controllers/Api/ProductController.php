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
        if($products->count() > 0){
            return response()->json([
                'status' => 200,
                'students' => $products
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'students' => 'No Records Found'
            ], 404);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                'status' => 200,
                'student' => $product
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such product Found!"
            ], 404);
        }

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:491',
            'price' =>' required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'error' => $validator->messages()
            ], 422);
        }else{
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            if($product){
                return response()->json([
                    'status' => 200,
                    'message' => "Product Created Successfully"
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
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
                'status' => 200,
                'student' => $product
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such product Found!"
            ], 404);
        }
    }


    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:491',
            'price' =>' required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'error' => $validator->messages()
            ], 422);
        }else{
            $product = Product::find($id);

            if($product){

                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Product Updated Successfully"
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
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
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No such product Found!"
            ], 404);
        }
    }

}


