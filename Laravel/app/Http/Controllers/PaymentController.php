<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('rental')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $rentals = Rental::all();
        return view('payments.create', compact('rentals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'amount'    => 'required|numeric|min:0',
            'paid_at'   => 'required|date',
            'method'    => 'required|string|max:50',
        ]);

        Payment::create($request->only('rental_id', 'amount', 'paid_at', 'method'));

        return redirect()->route('payments.index')
            ->with('success', 'Оплату додано.');
    }

    public function show(Payment $payment)
    {
        $payment->load('rental');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $rentals = Rental::all();
        return view('payments.edit', compact('payment', 'rentals'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'amount'    => 'required|numeric|min:0',
            'paid_at'   => 'required|date',
            'method'    => 'required|string|max:50',
        ]);

        $payment->update($request->only('rental_id', 'amount', 'paid_at', 'method'));

        return redirect()->route('payments.index')
            ->with('success', 'Оплату оновлено.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Оплату видалено.');
    }
}
