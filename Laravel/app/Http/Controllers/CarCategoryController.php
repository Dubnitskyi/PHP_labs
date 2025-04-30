<?php

namespace App\Http\Controllers;

use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    public function index(Request $r)
    {
        $filters = $r->only('name');
        $perPage = max(1,(int)$r->query('itemsPerPage',10));

        $cats = CarCategory::filter($filters)
            ->paginate($perPage)
            ->appends($filters + ['itemsPerPage'=>$perPage]);

        return view('car-categories.index', compact('cats','filters','perPage'));
    }


    public function create()
    {
        return view('car-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CarCategory::create($request->only('name'));

        return redirect()->route('car-categories.index')
            ->with('success', 'Категорія створена.');
    }

    public function show(CarCategory $carCategory)
    {
        return view('car-categories.show', compact('carCategory'));
    }

    public function edit(CarCategory $carCategory)
    {
        return view('car-categories.edit', compact('carCategory'));
    }

    public function update(Request $request, CarCategory $carCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $carCategory->update($request->only('name'));

        return redirect()->route('car-categories.index')
            ->with('success', 'Категорію оновлено.');
    }

    public function destroy(CarCategory $carCategory)
    {
        $carCategory->delete();

        return redirect()->route('car-categories.index')
            ->with('success', 'Категорію видалено.');
    }
}
