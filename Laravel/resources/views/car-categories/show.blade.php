@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Категорія #{{ $carCategory->id }}</h1>
        <p><strong>Назва:</strong> {{ $carCategory->name }}</p>
        <a href="{{ route('car-categories.index') }}" class="btn btn-secondary">Назад до списку</a>
    </div>
@endsection
