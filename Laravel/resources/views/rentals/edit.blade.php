@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редагувати оренду</h1>

        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('rentals.update', $rental) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Авто</label>
                <select name="car_id" class="form-select" required>
                    <option value="">– Оберіть –</option>
                    @foreach($cars as $c)
                        <option value="{{ $c->id }}"{{ old('car_id', $rental->car_id)==$c->id?' selected':'' }}>
                            {{ $c->brand }} {{ $c->model }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label class="form-label">Клієнт</label>
                <select name="client_id" class="form-select" required>
                    <option value="">– Оберіть –</option>
                    @foreach($clients as $cli)
                        <option value="{{ $cli->id }}"{{ old('client_id', $rental->client_id)==$cli->id?' selected':'' }}>
                            {{ $cli->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label class="form-label">Дата з</label>
                <input type="date" name="rent_from" class="form-control" value="{{ old('rent_from', $rental->rent_from) }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Дата до</label>
                <input type="date" name="rent_to" class="form-control" value="{{ old('rent_to', $rental->rent_to) }}" required>
            </div>
            <button class="btn btn-primary">Оновити</button>
            <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
