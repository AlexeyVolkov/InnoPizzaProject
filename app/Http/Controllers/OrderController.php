<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use App\OrderedPizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'customer' => 'required|numeric|min:1',
            'ordered_pizzas' => 'required|array',
            'ordered_pizzas.*.pizza_id' => 'required|numeric|min:1',
            'ordered_pizzas.*.size_id' => 'required|numeric|min:1',
            'ordered_pizzas.*.topping_id' => 'required|numeric|min:1',
            'ordered_pizzas.*.quantity' => 'required|numeric|min:1',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            dd($validator->errors());
        }

        $customer = Customer::where('id', $request->input('customer'))->first();
        if ($customer) {
            // customer exists
            // open a new Order
            $order = $customer->orders()->create();
            // Get an array from Request
            // $array = [
            //     'customer' => 3,
            //     'ordered_pizzas' => [
            //         [
            //             'pizza_id' => 3,
            //             'order_id' => 1,
            //             'size_id' => 1,
            //             'topping_id' => 1,
            //             'quantity' => 45
            //         ],
            //         [
            //             'pizza_id' => 3,
            //             'order_id' => 1,
            //             'size_id' => 1,
            //             'topping_id' => 1,
            //             'quantity' => 45
            //         ],
            //         [
            //             'pizza_id' => 3,
            //             'order_id' => 1,
            //             'size_id' => 1,
            //             'topping_id' => 1,
            //             'quantity' => 45
            //         ],
            //     ]
            // ];
            // Insert Ordered Pizzas
            $pizzas = $order->orderedPizzas()->createMany($request->input('ordered_pizzas'));

            return response()->json(['order' => $order, 'pizzas' => $pizzas], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}