@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редагувати клієнта</h1>

        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('clients.update', $client) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">ПІБ</label>
                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $client->full_name) }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Телефон</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required>
            </div>
            <button class="btn btn-primary">Оновити</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
