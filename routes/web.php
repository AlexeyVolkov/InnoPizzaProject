<?php

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
		$pizzas__price =  \App\Pizza::select('COUNT(price)')->whereIn('id', $pizzas__id)->get();
		$sizes = \App\Size::all();

		$pizzas__subtotal = $pizzas__price;

		return view(
			'bag',
			[
				'pizzas' => $pizzas,
				'sizes' => $sizes,
				'pizzas__total_price' => $pizzas__total_price,
			]
		);
	} else {
		return view('welcome');
	}
});