@extends('layouts.app')
@section('content')
<form action="checkout" class="form" method="post">
	{!! csrf_field() !!}

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

</form>
@endsection