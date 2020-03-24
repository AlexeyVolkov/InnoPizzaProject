<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddPizzasTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /** @test */
    function customer_can_add_pizzas()
    {
        $response = $this->post('/bag', [
            'pizzas__id' => [1, 5],
            'add__pizza_submit-button' => '1',
        ]);

        $this->assertDatabaseHas('orders', [
            'customer__id' => 'Example Title',
            'open' => 1,
        ]);
    }
}