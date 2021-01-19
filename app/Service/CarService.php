<?php


namespace App\Service;


use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CarService
{
    /**
     * Fill car data
     *
     * @param Car $car
     * @param CarRequest $data
     */
    public function fillCarData(Car $car, CarRequest $data)
    {
        $model = CarModel::find($data->model_id);
        $car->model_id = $model->id;
        $car->brand_id = $model->brand->id;
        $car->fill($data->except(['_token', '_method', 'image', 'model_id']));
        if($data->image){
            if($car->image_url){
                $this->deleteImage($car, $data->file('image'));
            } else {
                $this->saveImage( $data->file('image'), $car);
            }
        }
        $car->save();
    }

    /**
     * Save car image to disk
     *
     * @param UploadedFile $file
     * @param Car $car
     */
    private function saveImage(UploadedFile $file, Car $car)
    {
        $file = Storage::disk('public')
            ->put('/car/images/', $file);
        $car->image_url = config('app.url'). 'storage/' . $file;
        $car->save();
    }

    /**
     * Delete car image, if request has new image replace it
     *
     * @param Car $car
     * @param UploadedFile|null $file
     */
    public function deleteImage(Car $car, ?UploadedFile $file)
    {
        $url = explode(config('app.url'). 'storage/', $car->image_url);
        Storage::disk('public')->delete($url[1]);
        if($file){
            $this->saveImage($file, $car);
        }
    }
}
