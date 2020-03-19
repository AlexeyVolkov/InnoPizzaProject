<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedPizzasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordered_pizzas', function (Blueprint $table) {
			$table->id();
			$table->integer('pizza__id')->unsigned();
			$table->foreign('pizza__id')->references('id')->on('pizzas');
			$table->integer('order__id')->unsigned();
			$table->foreign('order__id')->references('id')->on('orders');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ordered_pizzas');
	}
}