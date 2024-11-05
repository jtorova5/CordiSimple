<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Editar Reserva</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="px-8 py-8">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Estado:</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        required>
                        <option value="1" {{ old('status', $reservation->status) == '1' ? 'selected' : '' }}>Activa
                        </option>
                        <option value="0" {{ old('status', $reservation->status) == '0' ? 'selected' : '' }}>
                            Cancelada</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="location_quantity" class="block text-gray-700 font-bold mb-2">Cantidad de
                        Locales:</label>
                    <input type="number" name="location_quantity" id="location_quantity"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('location_quantity', $reservation->location_quantity) }}" required>
                    @error('location_quantity')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="event_id" class="block text-gray-700 font-bold mb-2">Evento ID (opcional):</label>
                    <input type="number" name="event_id" id="event_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('event_id', $reservation->event_id) }}"
                        placeholder="Escribe el ID del evento (opcional)">
                    @error('event_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 font-bold mb-2">Usuario ID (opcional):</label>
                    <input type="number" name="user_id" id="user_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('user_id', $reservation->user_id) }}"
                        placeholder="Escribe el ID del usuario (opcional)">
                    @error('user_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('reservations.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar
                        Reserva</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>