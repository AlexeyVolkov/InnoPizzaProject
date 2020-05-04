<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use App\OrderedPizza;
use App\Delivery;
use App\Payment;
use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$rules = [
			'customer' => 'required|numeric|min:1',
		];
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			dd($validator->errors());
		}

		$customer = Customer::where('id', $request->input('customer'))->first();
		if ($customer) {
			// customer exists
			// open a new Order
			$order = $customer->orders()->orderBy('id', 'desc')->first();

			if ($order) {
				// Get Ordered Pizzas
				$ordered_pizzas = $order->orderedPizzas()->get();
				$ordered_pizzas_arr = [];
				if (!$ordered_pizzas || count($ordered_pizzas) < 1) {
					$ordered_pizzas = [];
				} else {
					// add total price
					foreach ($ordered_pizzas as $ordered_pizza) {
						$price = $ordered_pizza->pizza()->first()->price
							* $ordered_pizza->size()->first()->weight
							* $ordered_pizza->topping()->first()->weight
							* $ordered_pizza->quantity;
						$ordered_pizza->price = round($price, 2);
						$ordered_pizza->save();
					}
					// make a ([ordered_pizza, pizza]) collection
					foreach ($ordered_pizzas as $ordered_pizza) {
						$ordered_pizzas_arr[] = [
							'ordered_pizza' => $ordered_pizza,
							'pizza' => $ordered_pizza->pizza()->first()
						];
					}
				}

				return response()->json([
					'order' => $order,
					'ordered_pizzas' => $ordered_pizzas_arr,
				], 200);
			} else {
				// open a new Order
				$order = new Order();
				$order->comments = '';
				$order = $customer->orders()->save($order);
				return response()->json([
					'order' => $order,
					'ordered_pizzas' => [],
				], 200);
			}
		}
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
			//             'size_id' => 1,
			//             'topping_id' => 1,
			//             'quantity' => 45
			//         ],
			//         [
			//             'pizza_id' => 3,
			//             'size_id' => 1,
			//             'topping_id' => 1,
			//             'quantity' => 45
			//         ],
			//         [
			//             'pizza_id' => 3,
			//             'size_id' => 1,
			//             'topping_id' => 1,
			//             'quantity' => 45
			//         ],
			//     ]
			// ];
			// Insert Ordered Pizzas
			$ordered_pizzas = $order->orderedPizzas()->createMany($request->input('ordered_pizzas'));

			// add total price
			foreach ($ordered_pizzas as $ordered_pizza) {
				$price = $ordered_pizza->pizza()->first()->price
					* $ordered_pizza->size()->first()->weight
					* $ordered_pizza->topping()->first()->weight
					* $ordered_pizza->quantity;
				$ordered_pizza->price = round($price, 2);
				$ordered_pizza->save();
			}

			$ordered_pizzas = $order->orderedPizzas()->get();
			return response()->json([
				'order' => $order,
				'ordered_pizzas' => $ordered_pizzas,
			], 200);
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
		// $array = [
		//     'payment' => 1,
		//     'delivery' => 2
		// ];
		$rules = [
			'payment_id' => 'numeric|min:1',
			'delivery_id' => 'numeric|min:1',
			'pizza' => 'array',
			'pizza.*.pizza_id' => 'numeric|min:1',
			'pizza.*.size_id' => 'numeric|min:1',
			'pizza.*.topping_id' => 'numeric|min:1',
			'pizza.*.quantity' => 'numeric|min:1',
			'comments' => 'string'
		];
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			dd($validator->errors());
		}

		// defaults
		$output_pizzas = [];
		$labels = [];

		if ($request->input('comments')) {
			$order->update(
				[
					'comments' => $request->input('comments'),
				]
			);
		}
		if ($request->input('payment_id') && $request->input('delivery_id')) {
			$order->update(
				[
					'payment_id' => $request->input('payment_id'),
					'delivery_id' => $request->input('delivery_id'),
				]
			);
			// Get texts
			$labels = [
				'payment_label' => $order->payment()->first()->name,
				'delivery_label' => $order->delivery()->first()->name
			];
		}
		if ($request->input('pizza')) {
			// append Pizza
			$pizza = $request->input('pizza');
			if (is_array($pizza) && count($pizza) > 0) {
				$new_pizza = new OrderedPizza($request->input('pizza'));
				$order->orderedPizzas()->save($new_pizza);
			}
		}


		// prettify response
		$output_pizzas = [];
		$ordered_pizzas = $order->orderedPizzas()->get();

		// add total price
		foreach ($ordered_pizzas as $ordered_pizza) {
			$price = $ordered_pizza->pizza()->first()->price
				* $ordered_pizza->size()->first()->weight
				* $ordered_pizza->topping()->first()->weight
				* $ordered_pizza->quantity;
			$ordered_pizza->price = round($price, 2);
			$ordered_pizza->save();
		}
		// make a ([ordered_pizza, pizza]) collection
		foreach ($ordered_pizzas as $ordered_pizza) {
			$output_pizzas[] = [
				'ordered_pizza' => $ordered_pizza,
				'pizza' => $ordered_pizza->pizza()->first(),
			];
		}


		// complete (open) order or not
		if (count($output_pizzas) > 1 && $order->payment_id > 0 && $order->delivery_id > 0) {
			$order->update(
				[
					'open' => true,
				]
			);
		}

		return response()->json([
			'order' => $order,
			'ordered_pizzas' =>  $output_pizzas,
			'labels' => $labels
		], 200);
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
