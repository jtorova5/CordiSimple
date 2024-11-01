<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Listar todas las reservas
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario para crear una nueva reserva
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'status' => 'required|boolean',
            'location_quantity' => 'required|integer',
            'event_id' => 'nullable|exists:events,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Crear una nueva reserva
        $reservation = Reservation::create($validatedData);
        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'status' => 'boolean',
            'location_quantity' => 'integer',
            'event_id' => 'nullable|exists:events,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Actualizar la reserva
        $reservation->update($validatedData);
        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada con éxito.');
    }

    /**
     * Create a new reservation.
     */
    public function createReservation(Request $request)
    {
        return $this->store($request);
    }

    /**
     * Cancel a reservation.
     */
    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = false; // O cualquier otra lógica de cancelación
        $reservation->save();
        return redirect()->route('reservations.index')->with('success', 'Reserva cancelada con éxito.');
    }

    /**
     * Get a specific reservation.
     */
    public function getReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation);
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        return $this->destroy($reservation);
    }
}
