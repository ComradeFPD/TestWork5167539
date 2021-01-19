<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarBrandRequest;
use App\Models\CarBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarBrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $brands = CarBrand::paginate(10);
        return response()->view('car-brand.index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('car-brand.create', [
            'brand' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CarBrandRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CarBrandRequest $request)
    {
        CarBrand::create([
            'title' => $request->title
        ]);
        return redirect()->route('car-brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        $brand = CarBrand::findOrFail($id);
        return response()->view('car-brand.show', [
            'brand' => $brand
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id)
    {
        $brand = CarBrand::findOrFail($id);
        return response()->view('car-brand.edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarBrandRequest  $request
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(CarBrandRequest $request, int $id)
    {
        $brand = CarBrand::findOrFail($id);
        $brand->update($request->except(['_method', '_token']));
        return redirect()->route('car-brand.index');
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
        $brand = CarBrand::findOrFail($id);
        $brand->delete();
        return redirect()->back();
    }
}
