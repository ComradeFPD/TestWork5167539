<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $carBrand = CarBrand::factory()->create();
        return [
            'brand_id' => $carBrand->id,
            'model_id' => CarModel::factory()->create([
                'brand_id' => $carBrand->id
            ]),
            'color' => $this->faker->colorName,
            'year_of_manufacture' => $this->faker->date(),
            'transmission' => $this->faker->randomElement(['auto', 'manual']),
            'number' => $this->faker->word. ' '. $this->faker->numerify('#####'),
            'price_per_day' => $this->faker->randomNumber()
        ];
    }
}
