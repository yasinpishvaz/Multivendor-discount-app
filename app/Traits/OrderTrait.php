<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;



trait OrderTrait
{
    private $order_id;
    private $order_user_id;

    // save or initialize user orders temporary after click on payment and before pay bill
    public function SaveOrdersTemporary()
    {
        $cart = session()->get('cart');

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->description = 'تکمیل نشده';
            $order->save();

            $this->order_id = $order->id;
            $this->order_user_id = $order->user_id;

            foreach ($cart as $key => $value) {
                $orderItem = new OrderItem();
                $product = Product::find($key);
                $orderItem['order_id'] = $this->order_id;
                $orderItem['product_id'] = $key;
                $orderItem['price'] = $product->price;
                $orderItem['discount'] = $product->discount;
                $orderItem['quantity'] = $value['quantity'];
                $orderItem->save();
                Product::where('id', $key)->decrement('quantity', $value['quantity']);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }


    // calculate total amount of reserved prooduct by user
    public function ordersTotalAmount()
    {
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['discount'];
        }
        return $total;
    }

    public function generateCoupon($prefix = 'CPN_')
    {
        $orderedCoupons = OrderItem::all()->pluck('coupon_code')->toArray();
        $generatedCoupon = '';
        do {
            $str = rand();
            $generatedCoupon = $prefix . sha1($str);
        } while (in_array($generatedCoupon, $orderedCoupons));

        return $generatedCoupon;
    }


    public function setOrdersCoupon($orderId)
    {
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        foreach ($orderItems as $order) {
            $order->coupon_code = $this->generateCoupon();
            $order->update();
        }
    }
}
