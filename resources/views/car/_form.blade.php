<form action="{{ $car == null ? route('car.store') : route('car.update', $car->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="{{ $car == null ? 'POST' : 'PUT' }}">
    <div class="form-group">
        <label for="models">Модели</label>
        <select name="model_id" id="models" class="form-control">
            @foreach($models as $model)
                @if($car != null && $car->model_id == $model->id)
                    <option value="{{ $model->id }}" selected>{{ $model->title }}</option>
                @else
                    <option value="{{ $model->id }}">{{ $model->title }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="number">Госномер</label>
        <input type="text" name="number" id="number" value="{{ $car != null ? $car->number : '' }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="year-of-manufacture">Год выпуска</label>
        <input type="date" name="year_of_manufacture" id="year-of-manufacture"
               value="{{ $car != null ? $car->year_of_manufacture : '' }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="color">Цвет</label>
        <input type="text" name="color" id="color" value="{{ $car != null ? $car->color : '' }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="price-per-day">Цена в сутки</label>
        <input type="number" name="price_per_day" id="price-per-day"
               value="{{ $car != null ? $car->price_per_day : '' }}" class="form-control">
    </div>
    <div class="form-group">
        <div>Коробка передач</div>
        <label for="auto">Автоматическая</label>
        <input type="radio" class="form-check" name="transmission" id="auto" value="auto">
        <label for="manual">Ручная</label>
        <input type="radio" class="form-check" name="transmission" id="manual" value="manual">
    </div>
    <div class="form-group">
        <label for="image">Фотография машины</label>
        <input type="file" id="image" name="image" class="form-control-file">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>
