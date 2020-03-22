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

<h1>{{$customer__id}}</h1>

@endsection