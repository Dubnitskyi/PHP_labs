@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Автомобілі</h1>
        <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">+ Новий автомобіль</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>ID</th><th>Марка</th><th>Модель</th><th>Рік</th><th>Категорія</th><th>Ціна/день</th><th>Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->category->name }}</td>
                    <td>{{ $car->price_per_day }}</td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">Show</a>
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Видалити?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
