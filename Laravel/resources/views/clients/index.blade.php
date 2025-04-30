@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Клієнти</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">+ Новий клієнт</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead><tr><th>ID</th><th>ПІБ</th><th>Телефон</th><th>Email</th><th>Дії</th></tr></thead>
            <tbody>
            @foreach($clients as $cli)
                <tr>
                    <td>{{ $cli->id }}</td>
                    <td>{{ $cli->full_name }}</td>
                    <td>{{ $cli->phone }}</td>
                    <td>{{ $cli->email }}</td>
                    <td>
                        <a href="{{ route('clients.show', $cli) }}" class="btn btn-sm btn-info">Show</a>
                        <a href="{{ route('clients.edit', $cli) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('clients.destroy', $cli) }}" method="POST" class="d-inline">
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
