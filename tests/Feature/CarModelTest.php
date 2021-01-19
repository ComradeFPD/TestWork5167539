<?php

namespace Tests\Feature;

use App\Models\CarModel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarModelTest extends TestCase
{
   use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i create new model
     *
     * @return void
     */
    public function canICreateNewModel()
    {
        $this->withoutExceptionHandling();
       $model = CarModel::factory()->make()->toArray();
       $response = $this->post(route('car-model.store'), $model);
       $response->assertSessionHasNoErrors();
       $response->assertStatus(302);
       $this->assertDatabaseHas('car_models', ['title' => $model['title']]);
    }

    /**
     * @test Can i view all car models
     *
     * @return void
     */
    public function canIViewAllCarModels()
    {
        $this->withoutExceptionHandling();
        CarModel::factory()->count(10)->create();
        $model = CarModel::all()->shuffle()->first();
        $response = $this->get(route('car-model.index'));
        $response->assertStatus(200);
        $response->assertSee($model->title);
    }

    /**
     * @test Can i view selected car model
     *
     * @return void
     */
    public function canIViewSelectedCarModel()
    {
        $this->withoutExceptionHandling();
        $model = CarModel::factory()->create();
        $response = $this->get(route('car-model.show', $model->id));
        $response->assertStatus(200);
        $response->assertSee($model->title);
        $response->assertSee($model->brand->title);
    }

    /**
     * @test Can i update existing car model
     *
     * @return void
     */
    public function canIUpdateExistingCarModel()
    {
        $model = CarModel::factory()->create();
        $requestData = $model->toArray();
        $requestData['title'] = 'new awesome model';
        $response = $this->put(route('car-model.update', $model->id), $requestData);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('car_models', ['id' => $model->id]);
        $this->assertDatabaseMissing('car_models', ['title' => $model->title]);
    }

    /**
     * @test Can i delete car model
     *
     * @return void
     */
    public function canIDeleteCarModel()
    {
        $model = CarModel::factory()->create();
        $response = $this->delete(route('car-model.destroy', $model->id));
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('car_models', ['id' => $model->id]);
    }

    /**
     * @test Can model delete when brand delete
     *
     * @return void
     */
    public function canModelsDeleteWhenBrandDelete()
    {
        $model = CarModel::factory()->create();
        $brand = $model->brand;
        $brand->delete();
        $this->assertDatabaseMissing('car_brands', ['id' => $brand->id]);
        $this->assertEmpty(CarModel::all());
    }


}
