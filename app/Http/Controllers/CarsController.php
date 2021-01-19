<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarModel;
use App\Service\CarService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CarsController extends Controller
{
    private $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cars = Car::paginate(10);
        return response()->view('car.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $models = CarModel::all();
        return response()->view('car.create', [
            'car' => null,
            'models' => $models
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CarRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CarRequest $request)
    {
        $car = new Car();
        $this->service->fillCarData($car, $request);
        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show(int $id)
    {
        $car = Car::findOrFail($id);
        return response()->view('car.show', [
            'car' => $car
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit(int $id)
    {
        $car = Car::findOrFail($id);
        $models = CarModel::all();
        return response()->view('car.edit', [
            'car' => $car,
            'models' => $models
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarRequest  $request
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(CarRequest $request, int $id)
    {
        $car = Car::findOrFail($id);
        $this->service->fillCarData($car, $request);
        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $car = Car::findOrFail($id);
        $this->service->deleteImage($car, null);
        $car->delete();
        return redirect()->back();
    }
}
