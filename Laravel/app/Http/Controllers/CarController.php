<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('category')->get();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $categories = CarCategory::all();
        return view('cars.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand'           => 'required|string|max:255',
            'model'           => 'required|string|max:255',
            'year'            => 'required|integer|min:1900|max:' . date('Y'),
            'price_per_day'   => 'required|numeric|min:0',
            'car_category_id' => 'required|exists:car_categories,id',
        ]);

        Car::create($request->only([
            'brand', 'model', 'year', 'price_per_day', 'car_category_id'
        ]));

        return redirect()->route('cars.index')
            ->with('success', 'Автомобіль додано.');
    }

    public function show(Car $car)
    {
        $car->load('category');
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $categories = CarCategory::all();
        return view('cars.edit', compact('car', 'categories'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand'           => 'required|string|max:255',
            'model'           => 'required|string|max:255',
            'year'            => 'required|integer|min:1900|max:' . date('Y'),
            'price_per_day'   => 'required|numeric|min:0',
            'car_category_id' => 'required|exists:car_categories,id',
        ]);

        $car->update($request->only([
            'brand', 'model', 'year', 'price_per_day', 'car_category_id'
        ]));

        return redirect()->route('cars.index')
            ->with('success', 'Автомобіль оновлено.');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Автомобіль видалено.');
    }
}
