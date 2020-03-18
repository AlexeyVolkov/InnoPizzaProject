## Console

```
php artisan make:migration create_pizzas_table --create=pizzas
php artisan make:migration create_sizes_table --create=sizes
php artisan make:migration create_customers_table --create=customers
php artisan make:migration create_orders_table --create=orders

php artisan make:model --factory Pizza
php artisan make:model --factory Size
php artisan make:model --factory Customer
php artisan make:model --factory Order

php artisan make:seeder SizesTableSeeder
php artisan make:seeder CustomersTableSeeder
php artisan make:seeder PizzasTableSeeder
php artisan make:seeder OrdersTableSeeder

php artisan migrate:fresh --seed
```
