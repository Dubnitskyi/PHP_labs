@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Оренди</h1>
        <form class="row g-2 mb-3">
            <div class="col">
                <select name="car_id" class="form-select">
                    <option value="">– Авто –</option>
                    @foreach($cars as $c)
                        <option value="{{ $c->id }}" {{ ( $filters['car_id'] ?? '' )==$c->id?'selected':'' }}>
                            {{ $c->brand }} {{ $c->model }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="client_id" class="form-select">
                    <option value="">– Клієнт –</option>
                    @foreach($clients as $cli)
                        <option value="{{ $cli->id }}" {{ ( $filters['client_id'] ?? '' )==$cli->id?'selected':'' }}>
                            {{ $cli->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col"><input type="date" name="rent_from" class="form-control" value="{{ $filters['rent_from'] ?? '' }}"></div>
            <div class="col"><input type="date" name="rent_to"   class="form-control" value="{{ $filters['rent_to']   ?? '' }}"></div>
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
                <th>ID</th><th>Авто</th><th>Клієнт</th><th>З</th><th>До</th>
            </tr></thead><tbody>
            @foreach($rentals as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->car->brand }} {{ $r->car->model }}</td>
                    <td>{{ $r->client->full_name }}</td>
                    <td>{{ $r->rent_from }}</td>
                    <td>{{ $r->rent_to }}</td>
                </tr>
            @endforeach
            </tbody></table>

        {{ $rentals->links() }}
    </div>
@endsection
