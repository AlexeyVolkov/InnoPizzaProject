@extends('layouts.app')
@section('content')
<form action="checkout" class="form" method="post">
	{!! csrf_field() !!}

	<ol start="1" class="links links_row">
		<li class="heading_3">
			<a href="./" class="heading heading_3 heading_inline title m-b-md">
				<- Choose Pizza </a>
		</li>
		<li class="heading_1">
			<h1 class="heading heading_1 heading_inline title m-b-md">
				Review Bag:
			</h1>
		</li>
		<li class="heading_3">
			<button class="form__button form__button_inline heading heading_3 heading_inline" name="checkout_submit-button"
				type="submit" value="1">
				Checkout ->
			</button>
		</li>
	</ol>

	@if ($errors->any())
	<section class="text alert alert-danger" role="alert">
		Please fix the following errors:
		{{ $errors}}
	</section>
	@endif
	@if($errors->has('checkout_submit-button'))
	<span class="help-block">{{ $errors->first('checkout_submit-button') }}</span>
	@endif
	@if($errors->has('add__pizza_submit-button'))
	<span class="help-block">{{ $errors->first('add__pizza_submit-button') }}</span>
	@endif

	<section class="bag row">
		<figure class="figure_table">
			<table class="table table-actor">
				<caption class="table__caption">Your Pizzas</caption>
				<colgroup class="table__colgroup">
					<col class="table__col table__col-70">
					<col class="table__col table__col-30">
				</colgroup>
				<thead class="table__thead">
					<tr class="table__tr">
						<th class="table__th">Pizza</th>
						<th class="table__th">Price, $</th>
					</tr>
				</thead>
				<tfoot class="table__tfoot">
					<tr class="table__tr">
						<th class="table__th">Total</th>
						<th class="table__th">{{$pizzas__total}}</th>
					</tr>
				</tfoot>
				<tbody class="table__tbody">
					@foreach ($pizzas as $pizza)
					<tr class="table__tr">
						<td class="table__td">
							<details>
								<summary>
									{{ $pizza->name }}
								</summary>
								{{ $pizza->description }}
							</details>
						</td>
						<td class="table__td">{{ $pizza->price }}</td>
					</tr>
					@endforeach
					<tr class="table__tr">
						<td class="table__td">
							Subtotal
						</td>
						<td class="table__td">{{$pizzas__subtotal}}</td>
					</tr>
					<tr class="table__tr">
						<td class="table__td">
							Shipping
						</td>
						<td class="table__td">{{$pizzas__shipping}}</td>
					</tr>
				</tbody>
			</table>
		</figure>
	</section>
	<section class="row">
		<form action="checkout" class="form" method="post">
			<fieldset class="form__fieldset">
				<legend class="form__legend">Your bag</legend>
				<dl class="form-group">
					<dt class="form__dt">
						<label class="form__label">Delivery:</label>
					</dt>
					<dd class="form__dd">
						<div class="flex-row">
							<input class="form__input" id="delivery" name="pizza__delivery-method" title="PizzaHub'll drive to you"
								type="radio" value="delivery"><label class="form__label" for="delivery">I'd like it delivered.</label>
							<small class="form__text_muted form__text_small">PizzaHub'll drive to you.</small>
						</div>
						<div class="flex-row">
							<input class="form__input" id="take_away" name="pizza__delivery-method" title="You'll drive to PizzaHub"
								type="radio" value="take_away">
							<label class="form__label" for="take_away">I'll pick it up.</label>
							<small class="form__text_muted form__text_small">You'll drive to PizzaHub.</small>
						</div>
					</dd>
				</dl>
				<dl class="form-group">
					<dt class="form__dt">
						<label class="form__label">Payment:</label>
					</dt>
					<dd class="form__dd">
						<div class="flex-row">
							<input class="form__input" id="payment" name="pizza__payment-method"
								title="PizzaHub's courier has a terminal" type="radio" value="payment"><label class="form__label"
								for="payment">Bank Card</label>
							<small class="form__text_muted form__text_small">PizzaHub's courier has a terminal.</small>
						</div>
						<div class="flex-row">
							<input class="form__input" id="take_away" name="pizza__payment-method"
								title="PizzaHub's courier has change" type="radio" value="take_away">
							<label class="form__label" for="take_away">Cash</label>
							<small class="form__text_muted form__text_small">PizzaHub's courier has change.</small>
						</div>
					</dd>
				</dl>
			</fieldset>
		</form>
	</section>



</form>
@endsection