<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // var_dump('image');
        // validasi requuest
         $request->validate([
            'cashier_id' => 'required',
            'cashier_name' => 'required',
            'total_item' => 'required',
            'total_price' => 'required',
            'payment_amount' => 'required',
            'transaction_time' => 'required|boolean',
            'payment_method' => 'required',
            'order_items' => 'required'
         ]);
 
         // store order request
         $order = new Order;
         $order->cashier_id = $request->cashier_id;
         $order->cashier_name = $request->cashier_name;
         $order->total_item = $request->total_item;
         $order->payment_amount = $request->payment_amount;
         $order->payment_amount = $request->payment_amount;
         $order->transaction_time = $request->transaction_time;
         $order->payment_method = $request->payment_method;
         $order->save();

         // order item
         foreach($request->order_items as $item){
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quality = $item['quality'];
            $orderItem->total_price = $item['total_price'];
            $orderItem->save();
         };

         return response()->json(['status' => 'success','data' => $order], 200);
    }
}
