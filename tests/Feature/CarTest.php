<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CarTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i create new car
     *
     * @return void
     */
    public function canICreateNewCar()
    {
        $car = Car::factory()->make()->toArray();
        $response = $this->post(route('car.store'), $car);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('cars', ['number' => $car['number']]);
    }

    /**
     * @test Can i view all cars
     *
     * @return void
     */
    public function canIViewAllCars()
    {
        Car::factory()->count(10)->create();
        $car = Car::all()->shuffle()->first();
        $response = $this->get(route('car.index'));
        $response->assertStatus(200);
        $response->assertSee($car->number);
    }

    /**
     * @test Can i view selected car
     *
     * @return void
     */
    public function canIViewSelectedCar()
    {
        $car = Car::factory()->create();
        $response = $this->get(route('car.show', $car->id));
        $response->assertStatus(200);
        $response->assertSee($car->brand->title);
        $response->assertSee($car->model->title);
        $response->assertSee($car->number);
    }

    /**
     * @test Can i update selected car
     *
     * @return void
     */
    public function canIUpdateExistingCar()
    {
        $this->withoutExceptionHandling();
        $car = Car::factory()->create();
        $requestData = $car->toArray();
        $requestData['number'] = 'new awesome number';
        $response = $this->put(route('car.update', $car->id), $requestData);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('cars', ['id' => $car->id]);
        $this->assertDatabaseMissing('cars', ['number' => $car->number]);
    }

    /**
     * @test Can i delete car
     *
     * @return void
     */
    public function canIDeleteCar()
    {
        $car = Car::factory()->create();
        $response = $this->delete(route('car.destroy', $car->id));
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }

    /**
     * @test Can cars delete when model has been deleted
     *
     * @return void
     *
     * @throws Exception
     */
    public function canCarDeleteWhenModelDeleted()
    {
        $model = CarModel::factory()->create();
        Car::factory()->count(10)->create([
            'model_id' => $model->id
        ]);
        $model->delete();
        $this->assertDatabaseMissing('car_models', ['id' => $model->id]);
        $this->assertEmpty(Car::all());
    }

    /**
     * @test Can cars delete when brand has been deleted
     *
     * @return void
     *
     * @throws Exception
     */
    public function canCarDeleteWhenBrandDelete()
    {
        $brand = CarBrand::factory()->create();
        Car::factory()->count(10)->create([
            'brand_id' => $brand->id
        ]);
        $brand->delete();
        $this->assertDatabaseMissing('car_brands', ['id' => $brand->id]);
        $this->assertEmpty(Car::all());
    }

    /**
     * @test Can i create car with image
     *
     * @return void
     */
    public function canCreateCarWithImage()
    {
        Storage::fake('public');
        $car = Car::factory()->make()->toArray();
        $car['image'] = UploadedFile::fake()->image('test.jpg');
        $response = $this->post(route('car.store'), $car);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('cars', ['number' => $car['number']]);
        $this->assertNotNull(Car::whereNumber($car['number'])->first()->image_url);
    }

}
