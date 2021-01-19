@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('car-model.index')}}">Модели</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Создание модели</li>
                    </ol>
                </nav>
                @include('car-model._form', ['brands' => $brands, 'model' => $model])
            </div>
        </div>
    </div>
@endsection
