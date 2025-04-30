@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Створити клієнта</h1>

        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="mb-3"><label class="form-label">ПІБ</label>
                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Телефон</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="mb-3"><label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <button class="btn btn-success">Зберегти</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Скасувати</a>
        </form>
    </div>
@endsection
