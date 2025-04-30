<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $r)
    {
        $filters = $r->only('full_name','phone','email');
        $perPage = max(1,(int)$r->query('itemsPerPage',10));

        $clients = Client::filter($filters)
            ->paginate($perPage)
            ->appends($filters + ['itemsPerPage'=>$perPage]);

        return view('clients.index',compact('clients','filters','perPage'));
    }


    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:50',
            'email'     => 'required|email|max:100',
        ]);

        Client::create($request->only('full_name', 'phone', 'email'));

        return redirect()->route('clients.index')
            ->with('success', 'Клієнта додано.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:50',
            'email'     => 'required|email|max:100',
        ]);

        $client->update($request->only('full_name', 'phone', 'email'));

        return redirect()->route('clients.index')
            ->with('success', 'Клієнта оновлено.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Клієнта видалено.');
    }
}
