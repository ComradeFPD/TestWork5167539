@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Машины</li>
                    </ol>
                </nav>
                <a href="{{ route('car.create') }}" style="margin-bottom: 10px" class="btn btn-success">Добавить новую машину</a>
            </div>
            <div class="col-md-10">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Марка</th>
                        <th>Модель</th>
                        <th>Год выпуска</th>
                        <th>Госномер</th>
                        <th>Цвет</th>
                        <th>Коробка передач</th>
                        <th>Цена в сутки</th>
                        <th>Действия</th>
                    </tr>
                    @foreach($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>{{ $car->brand->title }}</td>
                            <td>{{ $car->model->title }}</td>
                            <td>{{ $car->year_of_manufacture }}</td>
                            <td>{{ $car->number }}</td>
                            <td>{{ $car->color }}</td>
                            <td>{{ $car->transmission }}</td>
                            <td>{{ $car->price_per_day }}</td>
                            <td>
                                <div class="row">
                                <a href="{{ route('car.show', $car->id) }}" class="btn btn-info margin-left-5">Показать</a>
                                <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning margin-left-5">Редактировать</a>
                                <form action="{{ route('car.destroy', $car->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger margin-left-5">Удалить</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
