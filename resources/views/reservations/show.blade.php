<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Detalles de la Reserva</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-8 py-6">

                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-gray-700 mb-2">Estado:</h2>
                    <p class="text-gray-600 text-lg">{{ $reservation->status ? 'Activa' : 'Cancelada' }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Cantidad de Locales:</h3>
                    <p class="text-gray-600 text-lg">{{ $reservation->location_quantity }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Evento ID:</h3>
                    <p class="text-gray-600 text-lg">{{ $reservation->event_id ?? 'No asignado' }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Usuario ID:</h3>
                    <p class="text-gray-600 text-lg">{{ $reservation->user_id ?? 'No asignado' }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Creada el:</h3>
                    <p class="text-gray-600 text-lg">
                        {{ $reservation->created_at ? $reservation->created_at->format('d-m-Y H:i:s') : 'Fecha no disponible' }}
                    </p>
                </div>

                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Última actualización:</h3>
                    <p class="text-gray-600 text-lg">
                        {{ $reservation->updated_at ? $reservation->updated_at->diffForHumans() : 'No ha sido actualizado' }}
                    </p>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('reservations.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Volver a la lista</a>
                    <a href="{{ route('reservations.edit', $reservation->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar Reserva</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
