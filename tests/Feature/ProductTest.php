<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_a_product_can_be_added()
    {
        $this->withoutExceptionHandling();

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

    public function test_that_a_product_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $login = $this->post('/api/register', [
            'name' => 'User 001',
            'email' => 'user001@teste.com',
            'password' => 'User@001',
            'password_confirmation' => 'User@001',
        ]);

        $productCreatedResponse = $this->withHeaders(
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

        $productUpdatedResponse = $this->withHeaders(
            [
                'Authorization' => 'Bearer '.$login['token'],
                'Accept' => 'application/json'
            ]
        )->put('/api/products/'.$productCreatedResponse['id'], [
            'name'=> 'IPhone 12 Pro Updated',
            'slug'=> 'iphone-12-pro-updated',
            'description'=> 'This is an IPhone 12 Pro Updated',
            'price'=> '899.99'
        ]);

        $productUpdatedResponse->assertStatus(200);
    }

    public function test_that_a_product_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $login = $this->post('/api/register', [
            'name' => 'User 001',
            'email' => 'user001@teste.com',
            'password' => 'User@001',
            'password_confirmation' => 'User@001',
        ]);

        $productCreatedResponse = $this->withHeaders(
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

        $productDeletedResponse = $this->withHeaders(
            [
                'Authorization' => 'Bearer '.$login['token'],
                'Accept' => 'application/json'
            ]
        )->delete('/api/products/'.$productCreatedResponse['id'], []);

        $productDeletedResponse->assertStatus(200);
        $this->assertTrue(count(Product::all()) === 0);
    }
}
