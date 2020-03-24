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
            ->orderBy('id', 'desc')
            ->exists();
    } else { // nothing stored in session
        $request->session()->forget('customer__id');
        return redirect('/');
    }
    if ($customer__exists) { // returned customer
        // define customer from Session
        $customer = \App\Customer::select('*')
            ->where('id', $customer__id)
            ->orderBy('id', 'desc')
            ->first();
        // check if customer has open order
        $order__exists = DB::table('orders')
            ->select('*')
            ->where('customer__id', $customer->id)
            ->where('open', true)
            ->orderBy('id', 'desc')
            ->exists();
        if ($order__exists) { // order is still open
            $order =  \App\Order::select('*')
                ->where('customer__id', $customer->id)
                ->where('open', true)
                ->orderBy('id', 'desc')
                ->first();
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
        ->orderBy('id', 'desc')
        ->exists();

    if ($pizzas__exists) {
        /**
         * | 2.2 Get the same pizzas from DB by ids
         */
        $pizzas = DB::table('pizzas')
            ->selectRaw('pizzas.*, ordered_pizzas.*, sizes.weight,  pizzas.price * ordered_pizzas.pizza__quantity * sizes.weight as total_price')
            ->join('ordered_pizzas', 'pizzas.id', '=', 'ordered_pizzas.pizza__id')
            ->join('sizes', 'ordered_pizzas.pizza__size_id', '=', 'sizes.id')
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
        ->join('sizes', 'ordered_pizzas.pizza__size_id', '=', 'sizes.id')
        ->where('ordered_pizzas.order__id', $order->id)
        ->sum(DB::raw('pizzas.price * ordered_pizzas.pizza__quantity * sizes.weight'));

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
            'order__id' => $order->id,
            'order' => $order,
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
            ->orderBy('id', 'desc')
            ->exists();
    } else {
        $customer__exists = false;
    }
    if ($customer__exists) { // returned customer
        // define customer from Session
        $customer = \App\Customer::select('*')
            ->where('id', $customer__id)
            ->orderBy('id', 'desc')
            ->first();
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
    if (is_array($pizzas__id) && count($pizzas__id) > 0) {
        /**
         * | 2.8 Open an order
         */
        $order = new Order();
        $order->customer__id = $customer->id;
        $order->open = true;
        $order->comments = '';
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
    $pizzas = DB::table('pizzas')
        ->selectRaw('pizzas.*, ordered_pizzas.*, sizes.weight,  pizzas.price * ordered_pizzas.pizza__quantity * sizes.weight as total_price')
        ->join('ordered_pizzas', 'pizzas.id', '=', 'ordered_pizzas.pizza__id')
        ->join('sizes', 'ordered_pizzas.pizza__size_id', '=', 'sizes.id')
        ->where('ordered_pizzas.order__id', $order->id)
        ->get();
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
            'order__id' => $order->id,
            'order' => $order,
        ]
    );
});

Route::post('/bag/update', function (Request $request) {

    $customer__id = $request->session()->get('customer__id', -1);
    $order__exists = false;
    if ($customer__id > 0) { // something stored in session
        // check if order exists
        $order__exists = DB::table('orders')
            ->select('*')
            ->where('customer__id', $customer__id)
            ->where('open', 1)
            ->exists();
    } else { // nothing stored in session
        $request->session()->forget('customer__id');
        return redirect('/');
    }
    if ($order__exists) { // order exists
        // define customer from Session
        $order = \App\Order::select('*')
            ->where('customer__id', $customer__id)
            ->where('open', 1)
            ->orderBy('id', 'desc')
            ->first();
    } else { // no open orders
        $request->session()->forget('customer__id');
        return redirect('/');
    }
    $order__id_form = $request->input('order__id');
    if ($order__id_form != $order->id) { // last order by session id not order by form
        return redirect('/');
    }

    $submit_button = $request->input('checkout_recalculate-button');

    if (1 == $submit_button) { // the form was submitted
        $pizzas = $request->input('pizzas');
        foreach ($pizzas as $pizza) {
            $affected = DB::table('ordered_pizzas')
                ->where('pizza__id', (int) $pizza['id'])
                ->where('order__id', (int) $order->id)
                ->update(
                    [
                        'pizza__quantity' => (int) $pizza['number'],
                        'pizza__size_id' => (int) $pizza['size']
                    ]
                );
        }
        $pizza__payment_method = $request->input('pizza__payment-method');
        $comments = $request->input('comments');
        $affected = DB::table('orders')
            ->where('id', $order->id)
            ->where('customer__id', (int) $customer__id)
            ->where('open', 1)
            ->update(
                [
                    'payment' => (int) $pizza__payment_method,
                    'comments' => $comments
                ]
            );

        return redirect('/bag');
    } else {
        return redirect('/');
    }
});

Route::get('/checkout', function (Request $request) {
    /**
     * | 2.0 If User Session exist goto 3
     */
    $customer__id = $request->session()->get('customer__id', -1);
    if ($customer__id > 0) { // something stored in session
        // check if customer exists
        $customer__exists = DB::table('customers')
            ->select('*')
            ->where('id', $customer__id)
            ->orderBy('id', 'desc')
            ->exists();
    } else { // nothing stored in session
        $request->session()->forget('customer__id');
        return redirect('/');
    }
    if ($customer__exists) { // returned customer
        // define customer from Session
        $customer = \App\Customer::select('*')
            ->where('id', $customer__id)
            ->orderBy('id', 'desc')
            ->first();
        // check if customer has open order
        $order__exists = DB::table('orders')
            ->select('*')
            ->where('customer__id', $customer->id)
            ->where('open', true)
            ->orderBy('id', 'desc')
            ->exists();
        if ($order__exists) { // order is still open
            $order =  \App\Order::select('*')
                ->where('customer__id', $customer->id)
                ->where('open', true)
                ->orderBy('id', 'desc')
                ->first();
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
        ->orderBy('id', 'desc')
        ->exists();

    if ($pizzas__exists) {
        /**
         * | 2.2 Get the same pizzas from DB by ids
         */
        $pizzas = DB::table('pizzas')
            ->selectRaw('pizzas.*, ordered_pizzas.*, sizes.weight,  pizzas.price * ordered_pizzas.pizza__quantity * sizes.weight as total_price')
            ->join('ordered_pizzas', 'pizzas.id', '=', 'ordered_pizzas.pizza__id')
            ->join('sizes', 'ordered_pizzas.pizza__size_id', '=', 'sizes.id')
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
        ->join('sizes', 'ordered_pizzas.pizza__size_id', '=', 'sizes.id')
        ->where('ordered_pizzas.order__id', $order->id)
        ->sum(DB::raw('pizzas.price * ordered_pizzas.pizza__quantity * sizes.weight'));

    $sizes = \App\Size::all();
    /**
     * | 2.5 Calculate prices
     */
    $pizzas__subtotal = $pizzas__price;
    $pizzas__shipping = $pizzas__subtotal * 0.10;
    $pizzas__total = $pizzas__subtotal + $pizzas__shipping;
    $pizzas__total_euro = $pizzas__total * 1.25;

    /**
     * | 2.6 Show bill draft and allow to choose size, etc.
     */
    return view(
        'checkout',
        [
            'pizzas' => $pizzas,
            'sizes' => $sizes,
            'pizzas__subtotal' => $pizzas__subtotal,
            'pizzas__shipping' => $pizzas__shipping,
            'pizzas__total' => $pizzas__total,
            'order__id' => $order->id,
            'order' => $order,
            'pizzas__total_euro' => $pizzas__total_euro,
        ]
    );
});


Route::post('/checkout', function (Request $request) {
});