@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Автомобіль #{{ $car->id }}</h1>
        <p><strong>Марка:</strong> {{ $car->brand }}</p>
        <p><strong>Модель:</strong> {{ $car->model }}</p>
        <p><strong>Рік:</strong> {{ $car->year }}</p>
        <p><strong>Категорія:</strong> {{ $car->category->name }}</p>
        <p><strong>Ціна/день:</strong> {{ $car->price_per_day }}</p>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Назад до списку</a>
    </div>
@endsection
