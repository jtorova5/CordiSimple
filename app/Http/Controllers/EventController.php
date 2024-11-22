<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        // Obtén y valida los datos del formulario
        $validatedData = $request->validated();
    
        // Crea el evento en la base de datos
        Event::create($validatedData);
    
        // Redirige al index con un mensaje de éxito
        return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Obtenemos la categoría por ID
        $category = Event::findOrFail($event);
        // Mostramos la vista de detalles con la categoría específica
        return view('events.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // if (!Auth::check() || !Auth::user()->role_id != 1) {
        //     return redirect()->route('events.index')->with('error', 'no tiene permiso para ver todos los eventos');
        // }

        $event = Event::findOrFail($event);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            // Más reglas según tu modelo
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Busca el evento por su ID
    $event = Event::find($id);

    // Verifica si el evento existe antes de intentar eliminarlo
    if ($event) {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }

    return redirect()->route('events.index')->with('error', 'El evento no fue encontrado.');
}

}
