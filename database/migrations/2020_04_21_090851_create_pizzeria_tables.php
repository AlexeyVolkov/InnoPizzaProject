<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzeriaTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pizzas', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 255)->comment('Name');
			$table->string('img_url', 255)->default('https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/11970.png')->comment('Photo');
			$table->longText('description');
			$table->float('price');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('customers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 255)->default('');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('sizes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 255)->default('Original');
			$table->float('weight')->default(1.0)->comments('Multiplies price');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('toppings', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->default('')->comment('Topping');
			$table->float('weight')->default(1.0)->comments('Multiplies price');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('payments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->default('')->comment('Payment type');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('deliveries', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->default('')->comment('Delivery type');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('orders', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('customer_id')->default(0);
			$table->boolean('open')->default(false);
			$table->unsignedBigInteger('payment_id')->default(1);
			$table->unsignedBigInteger('delivery_id')->default(1);
			$table->text('comments');
			$table->timestamps();
			$table->softDeletes();


			$table->foreign('customer_id')->references('id')->on('customers');
			$table->foreign('payment_id')->references('id')->on('payments');
			$table->foreign('delivery_id')->references('id')->on('deliveries');
		});

		Schema::create('ordered_pizzas', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('pizza_id');
			$table->unsignedBigInteger('order_id');
			$table->unsignedBigInteger('size_id');
			$table->unsignedBigInteger('topping_id');
			$table->integer('quantity')->default(1);
			$table->float('price')->default(0.0);
			$table->timestamps();
			$table->softDeletes();


			$table->foreign('pizza_id')->references('id')->on('pizzas');
			$table->foreign('order_id')->references('id')->on('orders');
			$table->foreign('size_id')->references('id')->on('sizes');
			$table->foreign('topping_id')->references('id')->on('toppings');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pizzas');
		Schema::dropIfExists('customers');
		Schema::dropIfExists('sizes');
		Schema::dropIfExists('orders');
		Schema::dropIfExists('ordered_pizzas');
		Schema::dropIfExists('payments');
		Schema::dropIfExists('deliveries');
		Schema::dropIfExists('toppings');
	}
}
