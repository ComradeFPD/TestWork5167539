<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarModelTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i get car model title
     *
     * @return void
     */
    public function canIGetModelTitle()
    {
        $model = CarModel::factory()->create();
        $this->assertNotNull($model->title);
    }

    /**
     * @test Can i get car model brand
     *
     * @return void
     */
    public function canIGetModelBrand()
    {
        $model = CarModel::factory()->create();
        $this->assertNotEmpty($model->brand);
    }

    /**
     * @test Can i get cars with this model
     *
     * @retun void
     */
    public function canIGetModelCars()
    {
        $model = CarModel::factory()->create();
        Car::factory()->count(15)->create([
            'model_id' => $model->id
        ]);
        $this->assertNotEmpty($model->cars);
    }
}
