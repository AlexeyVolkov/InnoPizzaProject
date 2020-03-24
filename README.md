# THE PIZZA TASK

## Live website

[https://puzzahub.herokuapp.com/](https://puzzahub.herokuapp.com/)

## SQL dump

-   `./dump.sql`

## Core Logic Flow

1. If `Customer` exists -> skip steps
1. Create new `Customer`
1. If `Customer` has open `Orders` -> skip steps
1. Get `Pizzas` selected by `Customer`
1. Create new `Order`
1. Calculate prices

## Core Code Flow

```php
Route::get('/'
    return view(
        'welcome',
        [
            'pizzas' => \App\Pizza::all(),
        ]
    );
});
```

```php
Route::get('/bag'
$pizzas = DB::table('pizzas')
            ->selectRaw('pizzas.*, ordered_pizzas.*, sizes.weight,  pizzas.price * ordered_pizzas.pizza__quantity * sizes.weight as total_price')
            ->join('ordered_pizzas', 'pizzas.id', '=', 'ordered_pizzas.pizza__id')
            ->join('sizes', 'ordered_pizzas.pizza__size_id', '=', 'sizes.id')
            ->where('ordered_pizzas.order__id', $order->id)
            ->get();
return view(
    'bag',
    [
        'pizzas' => $pizzas,
        'sizes' => $sizes,
        'pizzas__subtotal' => round(
            $pizzas__subtotal,
            1
        ),
        'pizzas__shipping' => round(
            $pizzas__shipping,
            1
        ),
        'pizzas__total' => round($pizzas__total, 1),
        'order__id' => $order->id,
        'order' => $order,
    ]
);
```

```php
Route::post('/bag/update'
DB::table('ordered_pizzas')
    ->where('pizza__id', (int) $pizza['id'])
    ->where('order__id', (int) $order->id)
    ->update(
        [
            'pizza__quantity' => (int) $pizza['number'],
            'pizza__size_id' => (int) $pizza['size']
        ]
    );
```

```php
Route::get('/checkout'
return view(
    'checkout',
    [
        'pizzas' => $pizzas,
        'sizes' => $sizes,
        'pizzas__subtotal' => round($pizzas__subtotal, 1),
        'pizzas__shipping' => round(
            $pizzas__shipping,
            1
        ),
        'pizzas__total' => round($pizzas__total, 1),
        'order__id' => $order->id,
        'order' => $order,
        'pizzas__total_euro' => round($pizzas__total_euro, 1),
        'payment' => $payment[$order->payment],
    ]
);
```

## Check List

### Requirements

-   [x] Your clients should be able to order pizzas from the menu
-   [x] The menu contains at least 8 pizzas
-   [x] You can decide what else you want in the menu
-   [x] Processing order/etc. with payment is NOT required. Concentrate on the interface to your pizza customer up to the point the customer confirms his order.
-   [x] The pizza order process should cover ordering single or several pizzas with definition of the quantity and calucation of a total price in Euros and US\$ also adding delivery costs to the bill.

### Technology (preferred as we use them in our company)

-   [ ] Frontend – ReactJS
-   [x] Backend – Laravel
-   [x] Database – MySQL
-   [ ] You get extra points for adding testing (for both frontend and backend);
-   [x] Design - you are free to use any framework or library whatever you want but keep in mind we primarly judge functionality and workflow. Less is more.

## Time spent

Total: 40 hours

28 hours (16.03.2020 - 19.03.2020)
12 hours (23.03.2020 - 24.03.2020)

## Sources

-   [Pizzas Description by pizzapizza.ca](https://www5.pizzapizza.ca/catalog/products/meat-favourites-12020/store/1/delivery)
-   [Design Inspiration by Yandex.Eda](https://eda.yandex/)

## Console

```
php artisan make:migration create_pizzas_table --create=pizzas
php artisan make:migration create_sizes_table --create=sizes
php artisan make:migration create_customers_table --create=customers
php artisan make:migration create_orders_table --create=orders
php artisan make:migration create_ordered_pizzas_table --create=ordered_pizzas

php artisan make:model --factory Pizza
php artisan make:model --factory Size
php artisan make:model --factory Customer
php artisan make:model --factory Order
php artisan make:model --factory OrderedPizza

php artisan make:seeder SizesTableSeeder
php artisan make:seeder CustomersTableSeeder
php artisan make:seeder PizzasTableSeeder
php artisan make:seeder OrdersTableSeeder
php artisan make:seeder OrderedPizzasTableSeeder

php artisan migrate:fresh --seed

php artisan make:test AddPizzasTest
```

## Hacks

-   `Less` was compiled by [PrePros](https://prepros.io/)
