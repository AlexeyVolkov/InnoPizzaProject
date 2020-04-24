# THE PIZZA TASK

## Live website

[https://puzzahub.herokuapp.com/](https://puzzahub.herokuapp.com/)

## SQL dump

-   `./dump.sql`

## Schema

### Models

-   Pizzas
-   Customers
-   Orders
-   Ordered Pizzas
-   PizzaSizes
-   Payments

## Algo

-   show all pizzas GET::'/pizzas'
    and get {pizzas, sizes, toppings}
-   add get customer by id GET::'/customer/' JSON:['customer'=>{id}]
    or new POST::'/customer/'
    and get {customer}
-   customer chooses pizzas and put it in a bag in vuejs
-   customer procceds to checkout POST::'/order' JSON:[?customer={customer_id}&ordered_pizzas={ordered_pizzas}]
    and got the response as {order_id, pizzas, checks, deliveries, payments}
-   customer chooses delivery and payment PUT::'/order/{id}' JSON:[payment={payment_id}&delivery={delivery_id}]
    and got the response as {Array pizzas, order}

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
php artisan make:migration create_pizzeria_tables --create=pizzas

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

php artisan make:controller OrderController --resource --model=Order

php artisan migrate:fresh --seed

php artisan make:test AddPizzasTest
```

## Hacks

-   `Less` was compiled by [PrePros](https://prepros.io/)
