@extends('layouts.app')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('car-brand.index') }}">Бренды</a></li>
                <li class="breadcrumb-item active" aria-current="page">Просмотр бренда</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">{{ $brand->id }}</h3>
            </div>
            <div class="card-body">
                <h4>{{ $brand->title }}</h4>
            </div>
        </div>
    </div>
    @endsection
