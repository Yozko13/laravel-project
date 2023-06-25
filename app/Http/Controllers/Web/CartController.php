<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;
use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\CartProduct;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends WebController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        DB::beginTransaction();

        try {
            $product = Product::find($request->product_id);

            if (!isset($product)) {
                return back()->with('error_message', __('The product is not availability'));
            }

            $session_id = Session::getId();

            $cart = Cart::where('session_id', $session_id)->whereOrdered(false)->orderBy('id', 'DESC')->first();
            if (isset($cart)) {
                for ($i = 1; $i <= $request->quantity; $i++) {
                    $cartProduct = CartProduct::create([
                        'cart_id'    => $cart->id,
                        'product_id' => $product->id,
                        'color_id'   => $request->color,
                        'name'       => $product->name,
                        'price'      => $product->price,
                    ]);

                    if (!isset($cartProduct)) {
                        throw new Exception("Is not create cart product", 1);
                    }
                }

                $cart->quantity  = $cart->quantity + $request->quantity;
                $cart->sum_price = $cart->sum_price + ($product->price * $request->quantity);
                $cart->save();

                DB::commit();

                return back()->with('success_message',
                    __('Successfully added :name to your cart', ['name' => $product->name])
                );
            }

            $cart = Cart::create([
                'session_id' => Session::getId(),
                'quantity'   => $request->quantity,
                'sum_price'  => $product->price * $request->quantity,
            ]);

            if (!isset($cart)) {
                throw new Exception("Is not create cart", 1);
            }

            for ($i = 1; $i <= $request->quantity; $i++) {
                $cartProduct = CartProduct::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                    'color_id'   => $request->color,
                    'name'       => $product->name,
                    'price'      => $product->price,
                ]);

                if (!isset($cartProduct)) {
                    throw new Exception("Is not create cart product", 1);
                }
            }

            DB::commit();

            return back()->with('success_message',
                __('Successfully added :name to your cart', ['name' => $product->name])
            );
        } catch (\Throwable $th) {
            report($th);

            DB::rollBack();

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        return $this->view('web.cart', compact('cart'));
    }
}
