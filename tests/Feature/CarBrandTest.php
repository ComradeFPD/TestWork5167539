<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarBrandTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i create new brand
     *
     * @return void
     */
    public function canICreateNewBrand()
    {
        $brand = CarBrand::factory()->make()->toArray();
        $response = $this->post(route('car-brand.store'), $brand);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('car_brands', ['title' => $brand['title']]);
    }

    /**
     * @test Can i view all brands
     *
     * @return void
     */
    public function canIViewAllBrand()
    {
        $this->withoutExceptionHandling();
        CarBrand::factory()->count(10)->create();
        $brand = CarBrand::all()->shuffle()->first();
        $response = $this->get(route('car-brand.index'));
        $response->assertStatus(200);
        $response->assertSee($brand->title);
    }

    /**
     * @test Can i view selected brand
     *
     * @return void
     */
    public function canIViewOneBrand()
    {
        $brand = CarBrand::factory()->create();
        $response = $this->get(route('car-brand.show', $brand->id));
        $response->assertStatus(200);
        $response->assertSee($brand->title);
    }

    /**
     * @test Can i update existing brand
     *
     * @return void
     */
    public function canIUpdateBrand()
    {
        $brand = CarBrand::factory()->create();
        $requestData = $brand->toArray();
        $requestData['title'] = 'New awesome title';
        $response = $this->put(route('car-brand.update', $brand->id), $requestData);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('car_brands', ['title' => $requestData['title']]);
        $this->assertDatabaseMissing('car_brands', ['title' => $brand->title]);
    }

    /**
     * @test Can i delete existing brand
     *
     * @return void
     */
    public function canIDeleteBrand()
    {
        $brand = CarBrand::factory()->create();
        $response = $this->delete(route('car-brand.destroy', $brand->id));
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('car_brands', ['id' => $brand->id]);
    }

    /**
     * @test Can i create brand with same title twice
     *
     * @return void
     */
    public function canICreateBrandWithExistingTitle()
    {
        $brand = CarBrand::factory()->create();
        $duplicateBrand = $brand->toArray();
        $response = $this->post(route('car-brand.store'), $duplicateBrand);
        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }
}
