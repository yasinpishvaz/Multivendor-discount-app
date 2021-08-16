<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cart()
    {
        return view('front.cart.cart');
    }



    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        // image problem in session should be solve!!!!!!!!!!!

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id =>
                [
                    'title' => $product->title,
                    'quantity' => 1,
                    'discount' => $product->discount,
                    'image' => $product->menu_image_path
                ]
            ];

            session()->put('cart', $cart);

            $htmlcart = view('front.header_cart')->render();
            return response()->json(['msg' => 'تخفیف با موفقیت به سبد خرید شما اضافه گردید', 'data' => $htmlcart]);
        }


        // if cart is not empty then check if this product exist then just increment their quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);
            $htmlcart = view('front.header_cart')->render();
            return response()->json(['msg' => 'تخفیف با موفقیت به سبد خرید شما اضافه گردید', 'data' => $htmlcart]);
        }

        // if cart exist but item not exist in cart then add to cart with quantity = 1
        $cart[$id] =
            [
                'title' => $product->title,
                'quantity' => 1,
                'discount' => $product->discount,
                'image' => $product->menu_image_path
            ];

        session()->put('cart', $cart);

        $htmlcart = view('front.header_cart')->render();
        return response()->json(['msg' => 'تخفیف با موفقیت به سبد خرید شما اضافه گردید', 'data' => $htmlcart]);
    }



    public function updateCartItem(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'cart upadated successfully!');
        }
    }



    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart');
        if ($request->id && isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            session()->flash('success', 'product remove successfully!');
        }
    }

    
}
