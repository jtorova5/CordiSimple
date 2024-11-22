<x-app-layout>
    <div class="container mx-auto py-8">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4 shadow">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-6 p-4 rounded-lg shadow-xl bg-blue-50 inline-block border-2">
                Mis Reservas
            </h1>
        </div>                                          

        <div class="bg-blue-50 shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-center text-base font-semibold uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-center text-base font-semibold uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-center text-base font-semibold uppercase tracking-wider">Cantidad de Ubicaciones</th>
                        <th class="px-6 py-3 text-center text-base font-semibold uppercase tracking-wider">Evento</th>
                        <th class="px-6 py-3 text-center text-base font-semibold uppercase tracking-wider">Usuario</th>
                        <th class="px-6 py-3 text-center text-base font-semibold uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-blue-50 divide-y divide-gray-200">
                    @forelse($reservations as $reservation)
                        <tr class="hover:bg-blue-100">
                            <td class="px-6 py-4 text-center text-base text-gray-900">{{ $reservation->id }}</td>
                            <td class="px-6 py-4 text-center text-base text-gray-900">{{ $reservation->status ? 'Activa' : 'Cancelada' }}</td>
                            <td class="px-6 py-4 text-center text-base text-gray-900">{{ $reservation->location_quantity }}</td>
                            <!-- Mostrar el nombre del evento -->
                            <td class="px-6 py-4 text-center text-base text-gray-900">{{ $reservation->event->name ?? 'Evento no disponible' }}</td>
                            <!-- Mostrar el nombre completo del usuario -->
                            <td class="px-6 py-4 text-center text-base text-gray-900">{{ $reservation->user->name ?? 'Usuario no disponible' }} {{ $reservation->user->last_name ?? '' }}</td>
                            <td class="px-6 py-4 text-center text-base font-medium">
                                <!-- Botón de detalles -->
                                <a href="{{ route('reservations.showUser', $reservation->id) }}" 
                                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition">
                                    Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay reservas disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
