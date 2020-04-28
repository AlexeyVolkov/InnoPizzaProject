<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Size;
use App\Topping;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$sort = $request->input('sort');
		switch ($sort) {
			case 'cheap':
				$pizzas = Pizza::orderBy('price', 'asc')->get();
				break;
			case 'expensive':
				$pizzas = Pizza::orderBy('price', 'desc')->get();
				break;
			case 'fat':
				$pizzas = Pizza::orderBy('fat', 'asc')->get();
				break;
			case 'favorless':
				$pizzas = Pizza::orderBy('fat', 'desc')->get();
				break;
			default:
				$pizzas = Pizza::all();
				break;
		}
		$sizes = Size::all();
		$toppings = Topping::all();
		return response()->json([
			'pizzas' => $pizzas,
			'sizes' => $sizes,
			'toppings' => $toppings
		], 200);
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Pizza  $pizza
	 * @return \Illuminate\Http\Response
	 */
	public function show(Pizza $pizza)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Pizza  $pizza
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Pizza $pizza)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Pizza  $pizza
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Pizza $pizza)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Pizza  $pizza
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Pizza $pizza)
	{
		//
	}
}
