@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Категорії авто</h1>
        <a href="{{ route('car-categories.create') }}" class="btn btn-primary mb-3">+ Нова категорія</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr><th>ID</th><th>Назва</th><th>Дії</th></tr>
            </thead>
            <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>
                        <a href="{{ route('car-categories.show', $cat) }}" class="btn btn-sm btn-info">Show</a>
                        <a href="{{ route('car-categories.edit', $cat) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('car-categories.destroy', $cat) }}" method="POST" class="d-inline">
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
