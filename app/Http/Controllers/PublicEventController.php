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
        try {
            $event = Event::findOrFail($id);

            // Validate ticket quantity
            $request->validate([
                'quantity' => 'required|integer|min:1|max:' . ($event->max_capacity - $event->sold),
            ]);

            $quantity = $request->input('quantity');

            \DB::beginTransaction();

            try {
                $event = Event::lockForUpdate()->findOrFail($id);

                if ($quantity > $event->max_capacity - $event->sold) {
                    \DB::rollBack();
                    return response()->json(['error' => 'No hay suficientes entradas disponibles.'], 400);
                }

                // Create reservation
                $reservation = Reservation::create([
                    'status' => 1,
                    'location_quantity' => $quantity,
                    'event_id' => $event->id,
                    'user_id' => Auth::id(),
                ]);

                $event->sold += $quantity;
                $event->save();

                \DB::commit();
                return response()->json(['message' => 'Entradas adquiridas con éxito.'], 200);
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar la compra: ' . $e->getMessage()], 500);
        }
    }
}
