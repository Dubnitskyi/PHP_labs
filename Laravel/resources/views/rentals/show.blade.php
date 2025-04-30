@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Оренда #{{ $rental->id }}</h1>
        <p><strong>Авто:</strong> {{ $rental->car->brand }} {{ $rental->car->model }}</p>
        <p><strong>Клієнт:</strong> {{ $rental->client->full_name }}</p>
        <p><strong>Дата з:</strong> {{ $rental->rent_from }}</p>
        <p><strong>Дата до:</strong> {{ $rental->rent_to }}</p>
        <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Назад до списку</a>
    </div>
@endsection
