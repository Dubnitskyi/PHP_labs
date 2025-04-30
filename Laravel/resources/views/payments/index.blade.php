@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Оплати</h1>
        <form class="row g-2 mb-3">
            <div class="col">
                <select name="rental_id" class="form-select">
                    <option value="">– Оренда –</option>
                    @foreach($rentals as $r)
                        <option value="{{ $r->id }}" {{ ( $filters['rental_id'] ?? '' )==$r->id?'selected':'' }}>
                            #{{ $r->id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col"><input name="amount"  class="form-control" placeholder="Сума" value="{{ $filters['amount'] ?? '' }}"></div>
            <div class="col"><input type="date" name="paid_at" class="form-control" value="{{ $filters['paid_at'] ?? '' }}"></div>
            <div class="col"><input name="method" class="form-control" placeholder="Метод" value="{{ $filters['method'] ?? '' }}"></div>
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
                <th>ID</th><th>Оренда</th><th>Сума</th><th>Дата</th><th>Метод</th>
            </tr></thead><tbody>
            @foreach($payments as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>#{{ $p->rental->id }}</td>
                    <td>{{ $p->amount }}</td>
                    <td>{{ $p->paid_at }}</td>
                    <td>{{ $p->method }}</td>
                </tr>
            @endforeach
            </tbody></table>

        {{ $payments->links() }}
    </div>
@endsection
