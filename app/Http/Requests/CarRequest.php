<?php

namespace App\Http\Requests;

use App\Models\Car;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CarRequest
 * @package App\Http\Requests
 *
 * @property string $color
 * @property int $number
 * @property string $transmission
 * @property integer $price_per_day
 * @property UploadedFile|null $image
 * @property int $model_id
 * @property string $year_of_manufacture
 */
class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $car = Car::whereNumber($this->request->get('number'))->first();
        return [
            'color' => 'min:3|max:100|string',
            'number' => $car != null ? "required|unique:cars,number, {$car->id}" : "required|unique:cars,number",
            'transmission' => 'required|in:auto,manual',
            'price_per_day' => 'required|min:1|integer',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,bmp',
            'model_id' => 'required|exists:car_models,id',
            'year_of_manufacture' => 'required'
        ];
    }
}
