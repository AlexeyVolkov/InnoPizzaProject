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

/*
|
| 1. Show all pizzas
|
| 2.0 If User Session exist goto 3
| 2.1 Get all pizzas selected by user
| 2.2 Get the same pizzas from DB by ids
| 2.3 Create a new Customer
| 2.4 Create a new Customer Session
| 2.5 Calculate prices
| 2.6 Show bill draft and allow to choose size, etc.
| 2.7 Put Customer Id to its Session
| 2.8 Open an order
|
| 3.1 Get Open order by Session.Customer.id else goto 2.0
| 3.2 Get all pizzas selected by user and goto 2.2
|
| 4. Calculate all hidden fees and sizes
| 4.1 Show bill, user`s id as a tracking code
| 4.2 Close an order
|
*/

/**
 * 1. Show all pizzas
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

Route::get('/bag', function (Request $request) {

    // flags
    $customer__new_order = true;

    /**
     * | 2.0 If User Session exist goto 3
     */
    $customer__id = $request->session()->get('customer__id', -1);
    if ($customer__id > 0) { // something stored in session
        // check if customer exists
        $customer__exists = DB::table('customers')
            ->select('*')
            ->where('id', $customer__id)
            ->exists();
    } else { // nothing stored in session
        $request->session()->forget('customer__id');
        return redirect('/');
    }
    if ($customer__exists) { // returned customer
        // define customer from Session
        $customer = \App\Customer::select('*')
            ->where('id', $customer__id)
            ->latest();
        // check if customer has open order
        $order__exists = DB::table('orders')
            ->select('*')
            ->where('customer__id', $customer->id)
            ->where('open', true)
            ->exists();
        if ($order__exists) { // order is still open
            $order =  \App\Order::select('*')
                ->where('customer__id', $customer->id)
                ->where('open', true)
                ->latest();
        } else { // no open orders -> main page
            $request->session()->forget('customer__id');
            return redirect('/');
        }
    } else { // new customer -> main page
        $request->session()->forget('customer__id');
        return redirect('/');
    }

    $pizzas__exists = DB::table('ordered_pizzas')
        ->select('pizza__id')
        ->where('order__id', $order->id)
        ->exists();

    if ($pizzas__exists) {
        /**
         * | 2.2 Get the same pizzas from DB by ids
         */
        $pizzas = DB::table('pizzas')
            ->select('*')
            ->join('ordered_pizzas', 'pizzas.id', '=', 'ordered_pizzas.pizza__id')
            ->where('ordered_pizzas.order__id', $order->id)
            ->get();
    } else { // customer didn't choose pizzas
        $request->session()->forget('customer__id');
        return redirect('/');
    }

    // pizzas prices
    $pizzas__price =  DB::table('pizzas')
        ->select('*')
        ->join('ordered_pizzas', 'pizzas.id', '=', 'ordered_pizzas.pizza__id')
        ->where('ordered_pizzas.order__id', $order->id)
        ->sum('price');

    $sizes = \App\Size::all();
    /**
     * | 2.5 Calculate prices
     */
    $pizzas__subtotal = $pizzas__price;
    $pizzas__shipping = $pizzas__subtotal * 0.10;
    $pizzas__total = $pizzas__subtotal + $pizzas__shipping;

    /**
     * | 2.6 Show bill draft and allow to choose size, etc.
     */
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
});

Route::post('/bag', function (Request $request) {

    // flags
    $customer__new_order = true;

    /**
     * | 2.0 If User Session exist goto 3
     */
    $customer__id = $request->session()->get('customer__id', -1);

    if ($customer__id > 0) {
        // check if customer exists
        $customer__exists = DB::table('customers')
            ->select('*')
            ->where('id', $customer__id)
            ->exists();
    } else {
        $customer__exists = false;
    }
    if ($customer__exists) { // returned customer
        // define customer from Session
        $customer = \App\Customer::select('*')
            ->where('id', $customer__id)
            ->latest();
    } else { // new customer
        /**
         * | 2.3 Create a new Customer
         */
        $customer = new Customer();
        $customer->name = 'New Customer';
        $customer->save(); // insert
        /**
         * | 2.4 Create a new Customer Session
         */
        /**
         * | 2.7 Put Customer Id to its Session
         */
        $request->session()->put('customer__id', $customer->id);
    }
    /**
     * | 2.1 Get all pizzas selected by user
     */
    $data = $request->validate(
        [
            'add__pizza_submit-button' => 'required',
            'pizzas__id' => '',
        ]
    );
    $pizzas__id = $request->input('pizzas__id');
    // customer chose pizzas
    if (is_array($pizzas__id) && count($pizzas__id) > 1) {
        /**
         * | 2.8 Open an order
         */
        $order = new Order();
        $order->customer__id = $customer->id;
        $order->open = true;
        // insert
        $order->save();
        /**
         * | 2.2 Get the same pizzas from DB by ids
         */
        $pizzas =  \App\Pizza::select('*')->whereIn('id', $pizzas__id)->get();

        // save pizzas in order
        foreach ($pizzas as $pizza) {
            // open orderedPizzas
            $orderedPizza = new OrderedPizza();
            $orderedPizza->order__id = $order->id;
            $orderedPizza->pizza__id = $pizza->id;
            // insert
            $orderedPizza->save();
        }
    } else { // customer didn't choose pizzas
        return redirect('/');
    }
    // pizzas prices
    $pizzas__price = DB::table('pizzas')
        ->select('*')
        ->join('ordered_pizzas', 'pizzas.id', '=', 'ordered_pizzas.pizza__id')
        ->where('ordered_pizzas.order__id', $order->id)
        ->sum('price');

    $sizes = \App\Size::all();
    /**
     * | 2.5 Calculate prices
     */
    $pizzas__subtotal = $pizzas__price;
    $pizzas__shipping = $pizzas__subtotal * 0.10;
    $pizzas__total = $pizzas__subtotal + $pizzas__shipping;

    /**
     * | 2.6 Show bill draft and allow to choose size, etc.
     */
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
});


Route::get('/checkout', function () {
    return view('checkout');
});

/**
 * 3. Show a bill
 */
Route::post('/checkout', function (Request $request) {
    // protected $fillable = ['pizza__add'];
    $data = $request->validate([
        'checkout_submit-button' => 'required',
        'pizzas__id' => '',
    ]);

    $user__id = Session::get('pizza.id', 34);
    return view(
        'checkout',
        [
            'customer__id' => $user__id,
        ]
    );
});