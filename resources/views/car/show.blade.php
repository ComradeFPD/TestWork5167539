@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('car.index') }}">Машины</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Просмотр машины</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">{{ $car->id }}</h3>
                    </div>
                    <div class="card-body">
                        <h4>Марка: {{ $car->brand->title }}</h4>
                        <h4>Модель: {{ $car->model->title }}</h4>
                        <h4>Госномер: {{ $car->number }}</h4>
                        <h4>Цвет: {{ $car->color }}</h4>
                        <h4>Цена за сутки: {{ $car->price_per_day }}</h4>
                        <h4>Год производства: {{ $car->year_of_manufacture }}</h4>
                        <h4>Коробка передач: {{ $car->transmission }}</h4>
                        <img src="{{ $car->image_url }}" width="300px" height="300px" alt="Фотография машины">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
