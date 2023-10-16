<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function getAllOrders(){
        return Order::all();
    }

    public function addOrder(Request $request){
        
        $order = new Order();
        $order->user_id = -1; // Auth::user()
        $order->order_date = Carbon::now();
        $order->is_paid = 0;
        
        if($request->address){
            $order->address = $request->address;
        }
        $order->save();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Order added successfully'
            ]
        );
    }

    public function getOrderById($id){
        $order = Order::find($id);
        if($order){
            return response()->json($order);
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Order not found'
                ]
            );
        }
    }

    public function deleteOrder($id){

        $order = Order::find($id);

        if (!$order) {
            return response()->json(
                ['message' => 'Order not found'],
                404
            );
        }

        $order->delete();
        return response()->json(
            [
                'success'=>true,
                'message'=>'Order deleted successfully'
            ]
        );
    }

    public function updateOrder(Request $request, $id){

        $order = Order::find($id);
        if (!$order) {
            return response()->json(
                ['message' => 'Order not found'],
                404
            );
        }

        $order->user_id = -1;
        // $order->order_date = Carbon::now();
        if(($request->is_paid == 0 || $request->is_paid == 1)){
            $order->is_paid = $request->is_paid;
        }
        if($order->address){
            $order->address = $request->address;
        }
        $order->save();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Orderd updated successfully'
            ]
        );
    }
}
