@extends('layouts.app')
@section('content')
<form action="bag" class="form" method="post">
    {!! csrf_field() !!}

    <ol start="1" class="links links_row">
        <li class="links__item heading_1">
            <h1 class="heading heading_1 heading_inline title m-b-md">
                Choose Pizza:
            </h1>
        </li>
        <li class="links__item heading_3">
            <button class="form__button form__button_inline heading heading_3 heading_inline text_mono"
                name="add__pizza_submit-button" type="submit" value="1" title="Next Step">
                Review bag ->
            </button>
        </li>
    </ol>

    @if ($errors->any())
    <section class="text alert alert-danger" role="alert">
        Please fix the following errors:
        {{ $errors}}
    </section>
    @endif
    @if($errors->has('pizzas__id'))
    <span class="help-block">{{ $errors->first('pizzas__id') }}</span>
    @endif
    @if($errors->has('add__pizza_submit-button'))
    <span class="help-block">{{ $errors->first('add__pizza_submit-button') }}</span>
    @endif

    <section class="pizzas row row_row">
        @foreach ($pizzas as $pizza)
        <article class="row__block pizza pizza__block">
            <fieldset class="form__fieldset">
                <legend class="form__legend">{{ $pizza->name }}</legend>
                <h3 class="heading heading_3">{{ $pizza->name }}</h3>
                <figure aria-label="{{ $pizza->name }}" role="figure" class="figure pizza__figure">
                    <img alt="{{ $pizza->name }}" src="" class="img figure__img">
                    <figcaption class="figure__figcaption screen-reader-text">{{ $pizza->name }}</figcaption>
                </figure>
                <div class="row row_row">
                    <div class="row__block pizza__price">${{ $pizza->price }}</div>
                    <div class="row__block pizza__add"><input class="form__input checkbox_big"
                            id="pizza__add_{{ $pizza->id }}" name="pizzas__id[]" title="Add {{ $pizza->name }} to bag"
                            type="checkbox" value="{{ $pizza->id }}">
                        <small class="form__text_muted form__text_small">
                            Add {{ $pizza->name }} to bag
                        </small></div>
                </div>
            </fieldset>
        </article>
        @endforeach
    </section>


    <ol start="1" class="links links_row block_hide-ipad">
        <li class="links__item heading_1">
            <h1 class="heading heading_1 heading_inline title m-b-md">
                Choose Pizza:
            </h1>
        </li>
        <li class="links__item heading_3">
            <button class="form__button form__button_inline heading heading_3 heading_inline text_mono"
                name="add__pizza_submit-button" type="submit" value="1" title="Next Step">
                Review bag ->
            </button>
        </li>
    </ol>
</form>
@endsection