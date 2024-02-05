<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::all();
        return response()->json([
            'status' => 200,
            'ratings' => $ratings
        ], 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'rating_value' => 'required|numeric|between:1,5'
        ]);
        if ($validator->fails()){
            return response()->json([
                'error' => $validator->message()
            ], 422);
        }else{
            $rating = Rating::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'rating_value' => $request->rating_value
            ]);

            if($rating){
                return response()->json([
                    'message' => "Rating Created Succesfully",
                    'rating' => $rating
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
        $rating = Rating::find($id);
        if($rating){
            $rating->delete();
            return response()->json([
                'message' => "Rating Deleted Successfully",
            ], 200);
        }else{
            return response()->json([
                'message' => "No such rating Found!"
            ], 404);
        }
    }
}

