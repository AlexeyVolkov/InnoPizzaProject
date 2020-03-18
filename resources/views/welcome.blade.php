@extends('layouts.app')
@section('content')
<form action="/add__pizza" class="form">

	<ol start="1" class="links links_row">
		<li class="heading_1">
			<h1 class="heading heading_1 heading_inline title m-b-md">
				Choose Pizza:
			</h1>
		</li>
		<li class="heading_3">
			<button class="form__button form__button_inline heading heading_3 heading_inline" name="add__pizza_submit-button"
				type="submit">
				Check Out ->
			</button>
		</li>
	</ol>


	<section class="pizzas row">
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
	</section>

</form>
@endsection