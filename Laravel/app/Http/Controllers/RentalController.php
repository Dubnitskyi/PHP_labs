<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\Client;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index(Request $r)
    {
        $filters = $r->only('rent_from','rent_to','car_id','client_id');
        $perPage = max(1,(int)$r->query('itemsPerPage',10));

        $cars    = Car::all();
        $clients = Client::all();

        $rentals = Rental::with(['car','clients'])
            ->filter($filters)
            ->paginate($perPage)
            ->appends($filters + ['itemsPerPage'=>$perPage]);

        return view('rentals.index',compact('rentals','filters','cars','clients','perPage'));
    }


    public function create()
    {
        $cars    = Car::all();
        $clients = Client::all();
        return view('rentals.create', compact('cars', 'clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id'    => 'required|exists:cars,id',
            'client_id' => 'required|exists:clients,id',
            'rent_from' => 'required|date|before_or_equal:rent_to',
            'rent_to'   => 'required|date|after_or_equal:rent_from',
        ]);

        Rental::create($request->only('car_id', 'client_id', 'rent_from', 'rent_to'));

        return redirect()->route('rentals.index')
            ->with('success', 'Оренда створена.');
    }

    public function show(Rental $rental)
    {
        $rental->load('car','clients');
        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        $cars    = Car::all();
        $clients = Client::all();
        return view('rentals.edit', compact('rental', 'cars', 'clients'));
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'car_id'    => 'required|exists:cars,id',
            'client_id' => 'required|exists:clients,id',
            'rent_from' => 'required|date|before_or_equal:rent_to',
            'rent_to'   => 'required|date|after_or_equal:rent_from',
        ]);

        $rental->update($request->only('car_id', 'client_id', 'rent_from', 'rent_to'));

        return redirect()->route('rentals.index')
            ->with('success', 'Оренда оновлена.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Оренда видалена.');
    }
}
