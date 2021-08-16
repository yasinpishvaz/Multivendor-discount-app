<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class CheckOrderItemsAvailability
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //check product or order availability
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            $product = Product::find($key);
            if ($product->quantity < $value['quantity']) {
                return redirect()->back()->withErrors('برخی از آیتم های سفارش تان به تعداد کافی موجود نمی باشند');
            } else {
                return $next($request);
            }
        }
    }
}
