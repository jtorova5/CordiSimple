<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicEventController extends Controller
{
    /**
     * Muestra la lista de eventos públicos.
     */
    public function index()
    {
        $events = Event::where('date', '>=', now())->get();
        return view('userEvents.index', compact('events'));
    }

    /**
     * Muestra los detalles de un evento específico.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    /**
     * Procesa la compra de entradas para un evento.
     */
    public function purchase(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Validación de la cantidad de entradas
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . ($event->max_capacity - $event->sold),
        ]);

        // Verifica la disponibilidad de entradas
        $quantity = $request->input('quantity');
        if ($quantity > ($event->max_capacity - $event->sold)) {
            return back()->with('error', 'No hay suficientes entradas disponibles.');
        }

        // Crea una reserva
        $reservation = Reservation::create([
            'status' => 'confirmed',
            'location_quantity' => $quantity,
            'event_id' => $event->id,
            'user_id' => Auth::id(),
        ]);

        // Actualiza el número de entradas vendidas del evento
        $event->sold += $quantity;
        $event->save();

        return back()->with('success', 'Entradas adquiridas con éxito.');
    }
}
