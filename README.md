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

<dl class="form-group">
					<dt class="form__dt">
						<label class="form__label" for="pizza__size_{{ $pizza->id }}">
							Size:
						</label>
					</dt>
					<dd class="form__dd">
						<select class="form__select" id="pizza__size_{{ $pizza->id }}" name="pizza__size" title="Pizza Size">
							@foreach ($sizes as $size)
							<option value="{{$size->id}}">{{$size->name}}</option>
							@endforeach
						</select>
						<small class="form__text_muted form__text_small">
							Pizza Size
						</small>
					</dd>
				</dl>

@foreach ($pizzas as $pizza)
<article class="row__block row__block_pizza">
<fieldset class="form__fieldset">
<figure aria-label="{{ $pizza->name }}" role="figure" class="figure">
<img alt="{{ $pizza->name }}" src="" class="img figure__img">
<figcaption class="figure__figcaption screen-reader-text">{{ $pizza->name }}</figcaption>
</figure>
<legend class="form__legend">{{ $pizza->name }}</legend>
<dl class="form-group">
<dt class="form__dt">
<label class="form__label" for="pizza__add_{{ $pizza->id }}">
Add:
</label>
</dt>
<dd class="form__dd">
<input class="form__input checkbox_big" id="pizza__add_{{ $pizza->id }}" name="pizza__add[]"
							title="Add {{ $pizza->name }} to basket" type="checkbox">
<small class="form__text_muted form__text_small">
Add {{ $pizza->name }} to basket
</small>
</dd>
</dl>
</fieldset>
</article>
@endforeach
