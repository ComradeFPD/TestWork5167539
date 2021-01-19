@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('car-model.index')}}">Модели</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Просмотр модели</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <h3>{{ $model->id }}</h3>
                </div>
                <div class="card-body">
                    <h4>Название: {{ $model->title }}</h4>
                    <h4>Марка: {{ $model->brand->title }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
