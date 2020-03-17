<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pizza', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('img_url');
			$table->longText('description');
			$table->integer('price');
			$table->integer('size__id')->unsigned();
			$table->foreign('size__id')->references('id')->on('size');
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
		Schema::dropIfExists('pizza');
	}
}