<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_list_all_the_product_for_a_seller()
    {
        Seller::factory()
            ->hasAttached(Product::factory(3)->hasImages(), ['stock' => 10, 'price' => '20.00'])
            ->create();

        $seller = Seller::first();

        $response = $this->get("api/v1/sellers/$seller->id/products")->assertOk();

        $this->assertCount(3, $response->json()['data']);
        $this->assertArrayHasKey('image_url', $response->json()['data'][0]['images'][0]);
    }

    /**
     * @test
     */
    public function it_should_paginatesd_list_of_the_products_for_a_seller()
    {
        $seller = Seller::factory()
            ->hasAttached(Product::factory(32), ['stock' => 10, 'price' => '20.00'])
            ->create();

        $page = 2;

        $response = $this->get("api/v1/sellers/$seller->id/products?page=$page")->assertOk();

        $metaData = $response->json()['meta'];

        $this->assertEquals(15, $metaData['per_page']);
        $this->assertEquals(2 ,$metaData['current_page']);
        $this->assertEquals(3 ,$metaData['last_page']);
        $this->assertEquals(32 ,$metaData['total']);
    }
}
