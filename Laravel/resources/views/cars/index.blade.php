@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Авто</h1>
        <form class="row g-2 mb-3">
            <div class="col"><input name="brand" value="{{ $filters['brand'] ?? '' }}" class="form-control" placeholder="Марка"></div>
            <div class="col"><input name="model" value="{{ $filters['model'] ?? '' }}" class="form-control" placeholder="Модель"></div>
            <div class="col"><input name="year"  value="{{ $filters['year']  ?? '' }}" class="form-control" placeholder="Рік"></div>
            <div class="col">
                <select name="car_category_id" class="form-select">
                    <option value="">– Категорія –</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ ( $filters['car_category_id'] ?? '' )==$c->id?'selected':'' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
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
                <th>ID</th><th>Марка</th><th>Модель</th><th>Рік</th><th>Категорія</th><th>Ціна</th>
            </tr></thead><tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->category->name }}</td>
                    <td>{{ $car->price_per_day }}</td>
                </tr>
            @endforeach
            </tbody></table>

        {{ $cars->links() }}
    </div>
@endsection
