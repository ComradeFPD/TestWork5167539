<form action="{{ $brand == null ? route('car-brand.store') : route('car-brand.update', $brand->id) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="{{ $brand == null ? 'POST' : 'PUT' }}">
    <div class="form-group">
        <label for="title">Название бренда</label>
        <input type="text" id="title" name="title" value="{{ $brand != null ? $brand->title : '' }}" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>
