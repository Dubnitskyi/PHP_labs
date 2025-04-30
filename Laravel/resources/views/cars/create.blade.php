@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Створити автомобіль</h1>

        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="mb-3"><label class="form-label">Марка</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Модель</label>
                <input type="text" name="model" class="form-control" value="{{ old('model') }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Рік</label>
                <input type="number" name="year" class="form-control" value="{{ old('year') }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Ціна за день</label>
                <input type="number" step="0.01" name="price_per_day" class="form-control" value="{{ old('price_per_day') }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Категорія</label>
                <select name="car_category_id" class="form-select" required>
                    <option value="">– Оберіть –</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}"{{ old('car_category_id')==$c->id?' selected':'' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success">Зберегти</button>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Скасувати</a>
        </form>
    </div>
@endsection
