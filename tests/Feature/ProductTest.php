<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_a_product_can_be_added()
    {
        $this->withoutExceptionHandling();

        //Logar para poder fazer insert
        $login = $this->post('/api/register', [
            'name' => 'User 001',
            'email' => 'user001@teste.com',
            'password' => 'User@001',
            'password_confirmation' => 'User@001',
        ]);

        $response = $this->withHeaders(
           [
               'Authorization' => 'Bearer '.$login['token'],
               'Accept' => 'application/json'
           ]
        )->post('/api/products', [
            'name'=> 'IPhone 12 Pro',
            'slug'=> 'iphone-12-pro',
            'description'=> 'This is an IPhone 12 Pro',
            'price'=> '999.99'
        ]);

        $response->assertStatus(201);
        $this->assertTrue(count(Product::all()) > 0);
    }
}
