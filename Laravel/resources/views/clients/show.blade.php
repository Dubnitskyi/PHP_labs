@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Клієнт #{{ $client->id }}</h1>
        <p><strong>ПІБ:</strong> {{ $client->full_name }}</p>
        <p><strong>Телефон:</strong> {{ $client->phone }}</p>
        <p><strong>Email:</strong> {{ $client->email }}</p>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Назад до списку</a>
    </div>
@endsection
