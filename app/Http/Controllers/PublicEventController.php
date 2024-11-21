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
        $events = Event::where('date', '>=', now())->where('sold', '<=', 'max_capacity')->get();

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

        // Validar la cantidad de entradas
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . ($event->max_capacity - $event->sold),
        ]);

        $quantity = $request->input('quantity');

        if ($quantity > $event->max_capacity - $event->sold) {
            return response()->json(['error' => 'No hay suficientes entradas disponibles.'], 400);
        }

        // Crear la reserva
        $reservation = Reservation::create([
            'status' => 'Activa',
            'location_quantity' => $quantity,
            'event_id' => $event->id,
            'user_id' => Auth::id(),
        ]);

        // Actualizar el número de entradas vendidas
        $event->sold += $quantity;
        $event->save();

        return response()->json(['message' => 'Entradas adquiridas con éxito.'], 200);
    }
}
