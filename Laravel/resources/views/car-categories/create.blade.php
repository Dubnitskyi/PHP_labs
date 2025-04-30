@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Створити категорію</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('car-categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <button class="btn btn-success">Зберегти</button>
            <a href="{{ route('car-categories.index') }}" class="btn btn-secondary">Скасувати</a>
        </form>
    </div>
@endsection
