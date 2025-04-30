@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Оплати</h1>
        <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">+ Нова оплата</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead><tr><th>ID</th><th>Оренда</th><th>Сума</th><th>Дата</th><th>Метод</th><th>Дії</th></tr></thead>
            <tbody>
            @foreach($payments as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>#{{ $p->rental->id }}</td>
                    <td>{{ $p->amount }}</td>
                    <td>{{ $p->paid_at }}</td>
                    <td>{{ $p->method }}</td>
                    <td>
                        <a href="{{ route('payments.show', $p) }}" class="btn btn-sm btn-info">Show</a>
                        <a href="{{ route('payments.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('payments.destroy', $p) }}" method="POST" class="d-inline">
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
