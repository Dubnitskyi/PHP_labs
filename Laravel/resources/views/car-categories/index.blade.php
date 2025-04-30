@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Категорії</h1>
        <form class="row g-2 mb-3">
            <div class="col"><input name="name" value="{{ $filters['name'] ?? '' }}" class="form-control" placeholder="Назва"></div>
            <div class="col-auto"><button class="btn btn-primary">Фільтр</button></div>
        </form>
        <form class="mb-3">
            <label>Items/page:</label>
            <input name="itemsPerPage" type="number" class="form-control d-inline-block w-auto" value="{{ $perPage }}">
            <button class="btn btn-secondary btn-sm">OK</button>
            @foreach($filters as $k=>$v)
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endforeach
        </form>
        <table class="table"><thead><tr><th>ID</th><th>Назва</th></tr></thead>
            <tbody>
            @foreach($cats as $c)
                <tr><td>{{ $c->id }}</td><td>{{ $c->name }}</td></tr>
            @endforeach
            </tbody>
        </table>
        {{ $cats->links() }}
    </div>
@endsection
