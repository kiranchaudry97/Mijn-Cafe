<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coffee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Toon bestellingen:
     * - Admin ziet alle bestellingen
     * - Gebruiker ziet alleen zijn eigen bestellingen
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            // Admin: alle bestellingen, inclusief gebruiker en koffie
            $orders = Order::with(['user', 'coffee'])->latest()->get();
            return view('admin.orders.index', compact('orders'));
        }

        // Gebruiker: alleen eigen bestellingen met koffie-relatie
        $orders = Order::with('coffee')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Formulier voor het plaatsen van een bestelling (alleen voor gebruikers)
     */
    public function create()
    {
        if (Auth::user()->is_admin) {
            abort(403, 'Admins kunnen geen bestellingen plaatsen.');
        }

        $coffees = Coffee::all();
        return view('orders.create', compact('coffees'));
    }

    /**
     * Opslaan van een nieuwe bestelling
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_admin) {
            abort(403);
        }

        $data = $request->validate([
            'coffee_id' => 'required|exists:coffees,id',
            'quantity'  => 'required|integer|min:1',
        ]);

        $data['user_id'] = Auth::id();
        Order::create($data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Bestelling geplaatst!');
    }

    /**
     * Verwijder een bestelling (alleen door de eigenaar)
     */
    public function destroy(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Bestelling verwijderd.');
    }
}
