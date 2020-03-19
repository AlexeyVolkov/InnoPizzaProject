<?php

use App\Order;
use App\OrderedPizza;
use App\Customer;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$pizzas = \App\Pizza::all();

	return view(
		'welcome',
		[
			'pizzas' => $pizzas,
		]
	);
});

Route::get('/bag', function () {
	return view('bag');
});

Route::post('/bag', function (Request $request) {
	// protected $fillable = ['pizza__add'];
	$data = $request->validate([
		'add__pizza_submit-button' => 'required',
		'pizzas__id' => '',
	]);
	$pizzas__id = $request->input('pizzas__id');
	if (is_array($pizzas__id) && count($pizzas__id) > 1) {
		$pizzas =  \App\Pizza::select('*')->whereIn('id', $pizzas__id)->get();

		// open customer
		$customer = new Customer();
		$customer->name = 'New Customer';
		// insert
		$customer->save();

		// open order
		$order = new Order();
		$order->customer__id = $customer->id;
		// insert
		$order->save();

		foreach ($pizzas as $pizza) {
			// open orderedPizzas
			$orderedPizza = new OrderedPizza();
			$orderedPizza->order__id = $order->id;
			$orderedPizza->pizza__id = $pizza->id;
			// insert
			$orderedPizza->save();
		}

		// pizzas prices
		$pizzas__price =  \App\Pizza::select('*')->whereIn('id', $pizzas__id)->sum('price');

		$sizes = \App\Size::all();

		$pizzas__subtotal = $pizzas__price;
		$pizzas__shipping = $pizzas__subtotal * 0.10;
		$pizzas__total = $pizzas__subtotal + $pizzas__shipping;

		return view(
			'bag',
			[
				'pizzas' => $pizzas,
				'sizes' => $sizes,
				'pizzas__subtotal' => $pizzas__subtotal,
				'pizzas__shipping' => $pizzas__shipping,
				'pizzas__total' => $pizzas__total,
			]
		);
	} else {
		return view('welcome');
	}
});


Route::get('/checkout', function () {
	return view('checkout');
});

Route::post('/checkout', function (Request $request) {
	// protected $fillable = ['pizza__add'];
	$data = $request->validate([
		'checkout_submit-button' => 'required',
		'pizzas__id' => '',
	]);
	return view(
		'checkout'
	);
});