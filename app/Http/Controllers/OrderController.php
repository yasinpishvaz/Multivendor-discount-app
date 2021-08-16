<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        $userId =  Auth::user()->id;
        $user = User::find($userId);
        $orders = $user->orders()->where('status', 1)->get();

        return view('front.orders.index', compact('orders'));
    }

    public function showUserOrderItems($id)
    {
        $orderItems = OrderItem::Where('order_id',$id)->get();
        return view('front.orders.orderItems', compact('orderItems'));
    }


    // orderDetails shows after transaction complete
    public function orderDetails($payment, $order)
    {
        $payment = Payment::where('id', $payment)->first();
        $order = OrderItem::where('order_id', $order)->get();
        return view('front.orders.verified', compact('payment', 'order'));
    }




    //admin

    public function allOrders()
    {
        $orders = Order::get();
        return view('back.orders.index', compact('orders'));
    }

    public function showAllOrderItems($id)
    {
        $orderItems = OrderItem::Where('order_id',$id)->get();
        return view('back.orders.orderItems', compact('orderItems'));
    }



}
