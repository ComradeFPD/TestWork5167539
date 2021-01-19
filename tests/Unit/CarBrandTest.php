<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarBrandTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i get car brand title
     *
     * @return void
     */
    public function canIGetCarBrandName()
    {
        $brand = CarBrand::factory()->create();
        $this->assertNotNull($brand->title);
    }

    /**
     * @test Can i get car models
     *
     * @return void
     */
    public function canIGetCarModels()
    {
        $brand = CarBrand::factory()->create();
        CarModel::factory()->count(10)->create([
            'brand_id' => $brand->id
        ]);
        $this->assertNotEmpty($brand->models);
    }

    /**
     * @test Can i get cars with this brand
     *
     * @return void
     */
    public function canIGetCars()
    {
        $brand = CarBrand::factory()->create();
        $carModel = CarModel::factory()->create([
            'brand_id' => $brand->id
        ]);
        Car::factory()->count(10)->create([
            'brand_id' => $carModel->brand_id,
            'model_id' => $carModel->id
        ]);
        $this->assertNotEmpty($brand->cars);
    }
}
