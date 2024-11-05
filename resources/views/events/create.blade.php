<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Crear Nuevo Evento</h1>

        <!-- Mostrar mensajes de error de validación -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear un evento -->
        <form action="{{ route('events.store') }}" method="POST">
            @csrf <!-- Token CSRF obligatorio para enviar formularios en Laravel -->

            <!-- Campos del formulario para los datos del evento -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del Evento:</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Descripción:</label>
                <textarea name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Fecha del Evento:</label>
                <input type="date" name="date" id="date" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{ old('date') }}" required>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-bold mb-2">Ubicación:</label>
                <input type="text" name="location" id="location" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{ old('location') }}" required>
            </div>

            <div class="mb-4">
                <label for="max_capacity" class="block text-gray-700 font-bold mb-2">Capacidad Máxima:</label>
                <input type="number" name="max_capacity" id="max_capacity" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{ old('max_capacity') }}" required>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end">
                <a href="{{ route('events.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear Evento</button>
            </div>
        </form>
    </div>
</x-app-layout>
