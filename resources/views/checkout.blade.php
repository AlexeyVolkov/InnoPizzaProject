@extends('layouts.app')
@section('content')

<ol start="1" class="links links_row">
    <li class="heading_3">
        <a href="./" class="link heading heading_3 heading_inline title m-b-md">
            <- Choose Pizza </a>
    </li>
    <li class="heading_3">
        <a href="./bag" class="link heading heading_3 heading_inline title m-b-md">
            <- Review Bag </a>
    </li>
    <li class="heading_1">
        <h1 class="heading heading_1 heading_inline title m-b-md">
            Checkout:
        </h1>
    </li>
</ol>
<h2 class="heading heading_1 heading_highlight">
    Your Tracking Number: {{$order->customer__id}}
</h2>
<section class="bag row">
    <figure class="figure_table">
        <table class="table table_checkout">
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
                    <th class="table__th">
                        <details>
                            <summary class="form__summary">
                                {{$pizzas__total}}
                            </summary>
                            €{{$pizzas__total_euro}}
                        </details>
                    </th>
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
                        {{$sizes[$pizza->pizza__size_id]->name}}

                    </td>
                    <td class="table__td">
                        {{ $pizza->pizza__quantity }}
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
<section class="bag row">
    <figure class="figure_table">
        <table class="table table_checkout">
            <caption class="table__caption">Bill</caption>
            <colgroup class="table__colgroup">
                <col class="table__col table__col-20">
                <col class="table__col table__col-80">
            </colgroup>
            <tbody class="table__tbody">
                <tr class="table__tr">
                    <td class="table__td">
                        Payment
                    </td>
                    <td class="table__td">{{$payment}}</td>
                </tr>
                <tr class="table__tr">
                    <td class="table__td">
                        Comments
                    </td>
                    <td class="table__td">{{$order->comments}}</td>
                </tr>
            </tbody>
        </table>
    </figure>
</section>

@endsection