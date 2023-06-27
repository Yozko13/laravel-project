<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at', 'DESC')
            ->when(request('status'), function ($q) {
                $q->whereStatus(request('status'));
            })
            ->paginate(20)
        ;

        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view('web.checkout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $cart = Cart::find($request->cart_id);

            if (!isset($cart)) {
                throw new Exception("Missing cart", 1);
            }

            $data = $request->except('_token');
            $data['cart_id']    = $cart->id;
            $data['session_id'] = Session::getId();
            $data['quantity']   = $cart->quantity;
            $data['sum_price']  = $cart->sum_price;

            $order = Order::create($data);

            if (!isset($order)) {
                throw new Exception("Is not create order", 1);
            }

            foreach ($cart->products as $product) {
                OrderProduct::create([
                    'order_id'    => $order->id,
                    'product_id'  => $product->product_id,
                    'color_id'    => $product->color_id,
                    'name'        => $product->name,
                    'price'       => $product->price,
                    'custom_text' => $product->custom_text,
                ]);
            }

            $cart->ordered = true;
            $cart->save();

            DB::commit();

            return to_route('home')->with('success_message', __('You have successfully placed your order'));
        } catch (\Throwable $th) {
            report($th);

            DB::rollBack();

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.order.details', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @param  integer $status
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Order $order, int $status)
    {
        DB::beginTransaction();

        try {
            $order->status = $status;
            $order->save();

            OrderStatus::create([
                'order_id' => $order->id,
                'status'   => $status,
            ]);

            DB::commit();

            return back()->with('success_message', __('Status changed successfully for order number :number', ['number' => $order->id]));
        } catch (\Throwable $th) {
            report($th);

            DB::rollBack();

            return back()->withErrors(['system_error' => __('System error')]);
        }
    }
}
