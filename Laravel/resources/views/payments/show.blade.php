@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Оплата #{{ $payment->id }}</h1>
        <p><strong>Оренда:</strong> #{{ $payment->rental->id }}</p>
        <p><strong>Сума:</strong> {{ $payment->amount }}</p>
        <p><strong>Дата оплати:</strong> {{ $payment->paid_at }}</p>
        <p><strong>Метод:</strong> {{ $payment->method }}</p>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Назад до списку</a>
    </div>
@endsection
