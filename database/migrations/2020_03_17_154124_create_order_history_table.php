<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_history', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('customer__id')->unsigned();
			$table->foreign('customer__id')->references('id')->on('customer');
			$table->integer('pizza__id')->unsigned();
			$table->foreign('pizza__id')->references('id')->on('pizza');
			$table->dateTime('date');
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
		Schema::dropIfExists('order_history');
	}
}