@extends('layouts.app')
@section('content')
<ol start="1" class="links links_row">
    <li class="heading_3">
        <a href="./" class="link heading heading_3 heading_inline title m-b-md">
            <- Choose Pizza </a>
    </li>
    <li class="heading_1">
        <h1 class="heading heading_1 heading_inline title m-b-md">
            Review Bag:
        </h1>
    </li>
    <li class="heading_3" value="4">
        <a href="./checkout" class="link heading_3 heading_inline">
            Checkout ->
        </a>
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

<form action="bag/update" class="form" method="post">
    {!! csrf_field() !!}
    <section class="bag row">
        <figure class="figure_table">
            <table class="table table-actor">
                <caption class="table__caption">Your Pizzas</caption>
                <colgroup class="table__colgroup">
                    <col class="table__col table__col-40">
                    <col class="table__col table__col-20">
                    <col class="table__col table__col-20">
                    <col class="table__col table__col-20">
                </colgroup>
                <thead class="table__thead">
                    <tr class="table__tr">
                        <th class="table__th">Pizza</th>
                        <th class="table__th">Size</th>
                        <th class="table__th">Number</th>
                        <th class="table__th">Price, $</th>
                    </tr>
                </thead>
                <tfoot class="table__tfoot">
                    <tr class="table__tr">
                        <th class="table__th" colspan="3">Total</th>
                        <th class="table__th">{{$pizzas__total}}</th>
                    </tr>
                </tfoot>
                <tbody class="table__tbody">
                    @foreach ($pizzas as $pizza)
                    <tr class="table__tr">
                        <td class="table__td">
                            <details>
                                <summary class="form__summary">
                                    {{ $pizza->name }}
                                </summary>
                                {{ $pizza->description }}
                            </details>
                        </td>
                        <td class="table__td">
                            <input type="hidden" name="pizzas[{{ $pizza->id }}][id]" value="{{ $pizza->pizza__id }}">
                            <select class="form__select form__input_width-auto" id="pizza__size_{{ $pizza->id }}"
                                name="pizzas[{{ $pizza->id }}][size]" title="{{ $pizza->name }} Size">
                                @foreach ($sizes as $size)
                                <option value="{{$size->id}}" @if ($size->id === $pizza->pizza__size_id) selected @endif
                                    >{{$size->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="table__td">
                            <input class="form__input form__input_width-small" name="pizzas[{{ $pizza->id}}][number]"
                                title="{{ $pizza->name }} quantity" type="number" min="1" max="15"
                                value="{{ $pizza->pizza__quantity }}" placeholder="{{ $pizza->pizza__quantity }}">
                        </td>
                        <td class="table__td">
                            <details>
                                <summary class="form__summary">
                                    <span title="Total Price">{{ $pizza->total_price }}</span>
                                </summary>
                                <span title="Initial Price">{{ $pizza->price }}</span> * <span
                                    title="Size">{{ $pizza->weight }}</span> * <span
                                    title="Quantity">{{ $pizza->pizza__quantity }}</span> =<span
                                    title="Total Price">{{ $pizza->total_price }}</span>
                            </details>
                        </td>
                    </tr> @endforeach <tr class="table__tr">
                        <td class="table__td" colspan="3">
                            Subtotal
                        </td>
                        <td class="table__td">{{$pizzas__subtotal}}</td>
                    </tr>
                    <tr class="table__tr">
                        <td class="table__td" colspan="3">
                            Shipping
                        </td>
                        <td class="table__td">{{$pizzas__shipping}}</td>
                    </tr>
                </tbody>
            </table>
        </figure>
    </section>

    <section class="row">
        <fieldset class="form__fieldset">
            <legend class="form__legend">Your bag</legend>
            <dl class="form-group">
                <dt class="form__dt">
                    <label class="form__label">Payment:</label>
                </dt>
                <dd class="form__dd">
                    <div class="flex-row">
                        <input class="form__input" id="pizza__payment-method_bank" name="pizza__payment-method"
                            title="PizzaHub's courier has a terminal" type="radio" value="1"><label class="form__label"
                            for="pizza__payment-method_bank">Bank Card</label>
                        <small class="form__text_muted form__text_small">PizzaHub's courier has a terminal.</small>
                    </div>
                    <div class="flex-row">
                        <input class="form__input" id="pizza__payment-method_cash" name="pizza__payment-method"
                            title="PizzaHub's courier has change" type="radio" value="2">
                        <label class="form__label" for="pizza__payment-method_cash">Cash</label>
                        <small class="form__text_muted form__text_small">PizzaHub's courier has change.</small>
                    </div>
                </dd>
            </dl>
            <dl class="form-group">
                <dt class="form__dt">
                    <label class="form__label" for="pizza__address">Address:</label>
                </dt>
                <dd class="form__dd"><textarea class="form__textarea" id="pizza__address" name="comments"
                        placeholder="Intercom pin is 543#" title="Any additional information"
                        spellcheck="false">{{$order->comments}}</textarea><small
                        class="form__text_muted form__text_small">Any additional
                        information.</small></dd>
                </dd>
            </dl>
            <dl class="form-group">
                <dt class="form__dt"></dt>
                <dd class="form__dd">
                    <input type="hidden" name="order__id" value="{{$order__id}}">
                    <button class="form__button heading heading_3 heading_inline" name="checkout_recalculate-button"
                        type="submit" value="1">
                        03. Recalculate sum
                    </button>
                </dd>
            </dl>
        </fieldset>
    </section>



</form>
@endsection