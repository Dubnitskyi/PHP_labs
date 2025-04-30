@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Клієнти</h1>
        <form class="row g-2 mb-3">
            <div class="col"><input name="full_name" value="{{ $filters['full_name'] ?? '' }}" class="form-control" placeholder="ПІБ"></div>
            <div class="col"><input name="phone"     value="{{ $filters['phone']     ?? '' }}" class="form-control" placeholder="Телефон"></div>
            <div class="col"><input name="email"     value="{{ $filters['email']     ?? '' }}" class="form-control" placeholder="Email"></div>
            <div class="col-auto"><button class="btn btn-primary">Фільтр</button></div>
        </form>

        <form class="mb-3">
            <label>Items/page:</label>
            <input name="itemsPerPage" type="number" value="{{ $perPage }}" class="form-control d-inline-block w-auto">
            <button class="btn btn-secondary btn-sm">OK</button>
            @foreach($filters as $k=>$v)
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endforeach
        </form>

        <table class="table"><thead><tr>
                <th>ID</th><th>ПІБ</th><th>Телефон</th><th>Email</th>
            </tr></thead><tbody>
            @foreach($clients as $cli)
                <tr>
                    <td>{{ $cli->id }}</td>
                    <td>{{ $cli->full_name }}</td>
                    <td>{{ $cli->phone }}</td>
                    <td>{{ $cli->email }}</td>
                </tr>
            @endforeach
            </tbody></table>

        {{ $clients->links() }}
    </div>
@endsection
