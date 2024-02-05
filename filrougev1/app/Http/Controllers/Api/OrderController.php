<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Pivots\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return response()->json([
            'status' => 200,
            'orders' => $orders
        ], 200);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if($order){
            return response()->json([
                'order' => $order
            ], 200);
        }else{
            return response()->json([
                'message' => "No Such order Found!"
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'is_confirmed' => 'required|in:0,1',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }else{
            $order = Order::create([
                'user_id' => $request->user_id,
                'total_price' => $request->total_price,
                'order_date' => $request->order_date,
                'is_confirmed' => $request->is_confirmed,
            ]);
            if($order){
                return response()->json([
                    'message' => "Order Created Successfully",
                    'order' => $order
                ], 200);
            }else{
                return response()->json([
                    'message' => "Some thing went wrong!"
                ], 500);
            }
        }
    }

    public function showOrderProducts($order_id)
    {
        $order = Order::find($order_id);
        return response()->json([
            'status' => 200,
            'orders_product' => $order->products
        ], 200);
    }


    public function addProduct (Request $request, $order_id)
    {
        $order = Order::find($order_id);
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }else{
            $product_id = $request->product_id;
            if ($order->products()->where('product_id', $product_id)->count() == 0) {
                $order->products()->attach($product_id, ['quantity' => $request->quantity]);
                return response()->json([
                    'message' => "OrderProduct Created Successfully",
                    'order' => $order
                ], 200);
            } else {
                // Product-order combination already exists, update the quantity.
                $existingPivot = $order->products()->where('product_id', $product_id)->first()->pivot;
                $newQuantity = $existingPivot->quantity + $request->quantity;

                $order->products()->updateExistingPivot($product_id, ['quantity' => $newQuantity]);

                return response()->json([
                    'message' => "OrderProduct Quantity Updated Successfully",
                    'order' => $order
                ], 200);
            }
        }
    }


    public function destroyProduct($id_order, $id_product)
    {
        $order = Order::find($id_order);
        $order->products()->detach($id_product);

        return response()->json([
                'message' => "OrderProduct Deleted Successfully",
            ], 200);
        // $existingOrderProduct = OrderProduct::where('order_id', $id_order)
        // ->where('product_id', $id_product)
        // ->first();

        // if($existingOrderProduct){
        //     $existingOrderProduct->delete();
        //     return response()->json([
        //         'message' => "OrderProduct Deleted Successfully",
        //     ], 200);
        // }else{
        //     return response()->json([
        //         'message' => "No such OrderProduct Found!"
        //     ], 404);
        // }
    }
}

