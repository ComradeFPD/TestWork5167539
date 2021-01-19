@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Брэнды</li>
                    </ol>
                </nav>
                <a href="{{ route('car-brand.create') }}" style="margin-bottom: 10px" class="btn btn-success">Добавить новый брэнд</a>
            </div>
            <div class="col-md-10">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->title }}</td>
                            <td>
                                <div class="row">
                                <a class="btn btn-info margin-left-5" href="{{ route('car-brand.show', $brand->id) }}">Посмотреть</a>
                                <a class="btn btn-warning margin-left-5" href="{{ route('car-brand.edit', $brand->id) }}">Редактировать</a>
                                <form action="{{ route('car-brand.destroy', $brand->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger margin-left-5" type="submit">Удалить</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
    @endsection
