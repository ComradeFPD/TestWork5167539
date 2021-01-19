<form action="{{ $model == null ? route('car-model.store') : route('car-model.update', $model->id) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="{{ $model == null ? 'POST' : 'PUT' }}">
    <div class="form-group">
        <label for="brands">Марка</label>
        <select name="brand_id" id="brands" class="form-control">
            @foreach($brands as $brand)
                @if($model != null && $model->brand_id = $brand->id)
                    <option value="{{ $brand->id }}" selected>{{ $brand->title }}</option>
                    @else
                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">Название модели</label>
        <input type="text" name="title" value="{{ $model != null ? $model->title : '' }}" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>
