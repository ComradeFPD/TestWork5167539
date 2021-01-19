<?php

namespace Tests\Unit;

use App\Models\Car;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarTest extends TestCase
{
   use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i get car number
     *
     * @return void
     */
    public function canIGetCarNumber()
    {
        $car = Car::factory()->create();
        $this->assertNotNull($car->number);
    }

    /**
     * @test Can i get car color
     *
     * @return void
     */
    public function canIGetCarColor()
    {
        $car = Car::factory()->create();
        $this->assertNotNull($car->color);
    }

    /**
     * @test Can i get car brand
     *
     * @return void
     */
    public function canIGetCarBrand()
    {
        $car = Car::factory()->create();
        $this->assertNotEmpty($car->brand);
    }

    /**
     * @test Can i get car model
     *
     * @return void
     */
    public function canIGetCarModel()
    {
        $car = Car::factory()->create();
        $this->assertNotEmpty($car->model);
    }

    /**
     * @test Can i get car transmission
     *
     * @return void
     */
    public function canIGetCarTransmission()
    {
        $car = Car::factory()->create();
        $this->assertNotEmpty($car->transmission);
    }

    /**
     * @test Can i get car year
     *
     * @return void
     */
    public function canIGetCarYear()
    {
        $car = Car::factory()->create();
        $this->assertNotEmpty($car->year_of_manufacture);
    }
}
