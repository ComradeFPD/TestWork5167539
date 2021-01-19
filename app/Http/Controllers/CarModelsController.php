<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarModelRequest;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $models = CarModel::paginate(10);
        return response()->view('car-model.index', [
            'models' => $models
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $brands = CarBrand::all();
        return response()->view('car-model.create', [
            'brands' => $brands,
            'model' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CarModelRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CarModelRequest $request)
    {
        $model = new CarModel();
        $model->fill($request->except(['_token', '_method']));
        $model->brand_id = $request->brand_id;
        $model->save();
        return redirect()->route('car-model.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        $model = CarModel::findOrFail($id);
        return response()->view('car-model.show', [
            'model' => $model
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
        $model = CarModel::findOrFail($id);
        $brands = CarBrand::all();
        return response()->view('car-model.edit', [
            'model' => $model,
            'brands' => $brands
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarModelRequest  $request
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(CarModelRequest $request, int $id)
    {
        $model = CarModel::findOrFail($id);
        $model->fill($request->except(['_token', '_method']));
        $model->brand_id = $request->brand_id;
        $model->save();
        return redirect()->route('car-model.index');
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
        $model = CarModel::findOrFail($id);
        $model->delete();
        return redirect()->back();
    }
}
