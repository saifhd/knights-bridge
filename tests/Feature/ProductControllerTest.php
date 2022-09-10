<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_be_list_all_the_products_with_images()
    {
        $product = Product::factory()
            ->hasImages(2)
            ->create();

        $response = $this->get('api/v1/products')->assertOk();

        $responseData = $response->json()['data'];

        $this->assertCount(1, $responseData);
        $this->assertCount(2, $responseData[0]['images']);

        $this->assertContains($product->description, $responseData[0]);

    }

    /**
     * @test
     */
    public function it_should_be_paginated_the_product_list()
    {
        Product::factory(35)->create();

        $page = 2;
        $response = $this->get("api/v1/products?page=$page")->assertOk();

        $metaData = $response->json()['meta'];

        $this->assertEquals(35, $metaData['total']);
        $this->assertEquals(15, $metaData['per_page']);
        $this->assertEquals(2, $metaData['current_page']);
        $this->assertEquals(3, $metaData['last_page']);

    }

    /**
     * @test
     */
    public function it_can_show_single_product_with_images_and_sellers()
    {
        $product = Product::factory()
            ->hasImages(3)
            ->create();

        Seller::factory(10)
            ->hasAttached($product, ['stock' => 10, 'price' => '20.00'])
            ->create();

        $response = $this->get("api/v1/products/$product->id")->assertOk();

        $responseData = $response->json();

        $this->assertCount(3, $responseData['data']['images']);
        $this->assertCount(10, $responseData['data']['sellers']);

    }

    /**
     * @test
     */
    public function it_can_be_list_seller_details_for_a_product()
    {
        $product = Product::factory()->create();

        Seller::factory(10)
            ->hasAttached($product, ['stock' => 10, 'price' => '20.00'])
            ->create();

        Seller::factory(10)->create();

        $response = $this->get("api/v1/products/$product->id/sellers")->assertOk();

        $responseData = $response->json()['data'];

        $this->assertCount(10, $responseData);

    }

}
