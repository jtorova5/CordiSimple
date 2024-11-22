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

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Listado de Eventos</h1>

        <div class="flex justify-end mb-4">
            <a href="{{ route('events.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Nuevo evento</a>
        </div>

        <!-- Contenedor de cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($events as $event)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $event->name }}</h2>
                        <p class="text-gray-600 mb-2"><strong>Descripción:</strong> {{ $event->description }}</p>
                        <p class="text-gray-600 mb-2"><strong>Fecha:</strong> {{ $event->date }}</p>
                        <p class="text-gray-600 mb-2"><strong>Ubicación:</strong> {{ $event->location }}</p>
                        <p class="text-gray-600 mb-2"><strong>Capacidad Máxima:</strong> {{ $event->max_capacity }}</p>
                        <p class="text-gray-600 mb-2"><strong>Vendidos:</strong> {{ $event->sold }}</p>
                        <p class="text-gray-600 mb-2"><strong>Administrador ID:</strong> {{ $event->admin_id }}</p>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
                        <!-- Botón para abrir modal de edición -->
                        <button onclick="openEditModal({{ $event }})"
                                class="text-indigo-600 hover:text-indigo-800">Editar</button>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 col-span-full">
                    No hay eventos disponibles.
                </div>
            @endforelse
        </div>

        <!-- Modal de edición -->
        <div id="editModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Editar Evento</h2>
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Nombre del Evento</label>
                        <input type="text" name="name" id="editName" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Descripción</label>
                        <textarea name="description" id="editDescription" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700">Fecha</label>
                        <input type="date" name="date" id="editDate" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="location" class="block text-gray-700">Ubicación</label>
                        <input type="text" name="location" id="editLocation" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="max_capacity" class="block text-gray-700">Capacidad Máxima</label>
                        <input type="number" name="max_capacity" id="editMaxCapacity" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Abre el modal de edición y rellena los campos
        function openEditModal(event) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editForm').action = `/events/${event.id}`;
            document.getElementById('editName').value = event.name;
            document.getElementById('editDescription').value = event.description;
            document.getElementById('editDate').value = event.date;
            document.getElementById('editLocation').value = event.location;
            document.getElementById('editMaxCapacity').value = event.max_capacity;
        }

        // Cierra el modal de edición
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
