@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Модели</li>
                    </ol>
                </nav>
                <a href="{{ route('car-model.create') }}" style="margin-bottom: 10px" class="btn btn-success">Добавить новую модель</a>
            </div>
            <div class="col-md-10">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Марка</th>
                    <th>Модель</th>
                    <th>Действия</th>
                </tr>
                @foreach($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->brand->title }}</td>
                        <td>{{ $model->title }}</td>
                        <td>
                            <div class="row">
                            <a href="{{ route('car-model.show', $model->id) }}" class="btn btn-info margin-left-5">Показать</a>
                            <a href="{{ route('car-model.edit', $model->id) }}" class="btn btn-warning margin-left-5">Редактировать</a>
                            <form action="{{ route('car-model.destroy', $model->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger margin-left-5">Удалить</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
                {{ $models->links() }}
            </div>
        </div>
    </div>
@endsection
