<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title') | Открытый Ресторан</title>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<header class="">
				<section class="address row justify-content-center">
					<form action="" method="get" class="col-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">📍</span>
							</div>
							<label class="sr-only" for="addressInput">Адрес доставки</label>
							<input type="text" class="form-control form-control-lg" id="addressInput"
								placeholder="Адрес доставки" title="Бесконтактная доставка">
							<small id="addressInputHelp" class="sr-only form-text text-muted">Бесконтактная
								доставка</small>
						</div>
					</form>
				</section>
				<section class="row justify-content-center">
					<form action="" method="get" class="col-6">
						<div class="form-group">
							<label class="sr-only" for="filterSelect">Фильтровать пиццы</label>
							<select class="form-control" id="filterSelect">
								<option>Дешевле</option>
								<option>Дороже</option>
								<option>Жирнее</option>
								<option>Преснее</option>
							</select>
						</div>
					</form>
				</section>
			</header>
			<main class="container">
				@yield('content')
			</main>
		</div>

		<script src="{{ asset('js/app.js')}}"></script>
	</body>

</html>
