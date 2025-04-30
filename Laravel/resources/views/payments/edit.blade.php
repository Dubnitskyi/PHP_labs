@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редагувати оплату</h1>

        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Оренда</label>
                <select name="rental_id" class="form-select" required>
                    <option value="">– Оберіть –</option>
                    @foreach($rentals as $r)
                        <option value="{{ $r->id }}"{{ old('rental_id', $payment->rental_id)==$r->id?' selected':'' }}>
                            #{{ $r->id }} ({{ $r->car->brand }} {{ $r->car->model }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label class="form-label">Сума</label>
                <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Дата оплати</label>
                <input type="date" name="paid_at" class="form-control" value="{{ old('paid_at', $payment->paid_at) }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Метод</label>
                <input type="text" name="method" class="form-control" value="{{ old('method', $payment->method) }}" required>
            </div>
            <button class="btn btn-primary">Оновити</button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
