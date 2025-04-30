@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Оренди</h1>
        <a href="{{ route('rentals.create') }}" class="btn btn-primary mb-3">+ Нова оренда</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead><tr><th>ID</th><th>Авто</th><th>Клієнт</th><th>З</th><th>До</th><th>Дії</th></tr></thead>
            <tbody>
            @foreach($rentals as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->car->brand }} {{ $r->car->model }}</td>
                    <td>{{ $r->client->full_name }}</td>
                    <td>{{ $r->rent_from }}</td>
                    <td>{{ $r->rent_to }}</td>
                    <td>
                        <a href="{{ route('rentals.show', $r) }}" class="btn btn-sm btn-info">Show</a>
                        <a href="{{ route('rentals.edit', $r) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('rentals.destroy', $r) }}" method="POST" class="d-inline">
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
