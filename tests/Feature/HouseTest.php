<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseTest extends TestCase
{
    public function test_get_search_data_by_price(): void
    {
        $response = $this->json('GET', '/api/v1/search', [
            'price' => [0, 1000000]
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(9, 'data');

        $response = $this->json('GET', '/api/v1/search', [
            'price' => [0, 300000]
        ]);
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_get_search_data_by_name(): void
    {
        $response = $this->json('GET', '/api/v1/search', [
            'name' => 'ia'
        ]);
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');

        $response = $this->json('GET', '/api/v1/search', [
            'name' => 'vic'
        ]);
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_get_search_data_by_bedroom(): void
    {
        $this->refreshApplication();
        $response = $this->json('GET', '/api/v1/search', [
            'bedrooms' => 5
        ]);
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_get_search_data_by_bedroom_and_bathroom(): void
    {
        $this->refreshApplication();
        $response = $this->json('GET', '/api/v1/search', [
            'bedrooms' => 4,
            'bathrooms' => 3,
        ]);
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }
}
