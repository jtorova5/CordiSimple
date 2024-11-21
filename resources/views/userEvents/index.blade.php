<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Eventos Disponibles</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white shadow-md rounded-lg p-6">
                    {{-- <img src="{{ $event->image }}" alt="Event image" class="w-full h-48 object-cover mb-4 rounded"> --}}
                    <h2 class="text-xl font-semibold text-gray-800">{{ $event->name }}</h2>
                    <p class="text-gray-600">{{ $event->date }}</p>

                    <div class="flex justify-between mt-4">
                        <button onclick="showEventDetails({{ $event->id }})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver Detalles</button>
                        <button onclick="showPurchasePopup({{ $event->id }})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Adquirir Entradas</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popup de Detalles del Evento -->
    <div id="detailsPopup" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
            <h3 id="eventDetailsName" class="text-2xl font-bold mb-4"></h3>
            <p id="eventDetailsDescription" class="text-gray-600 mb-4"></p>
            <button onclick="closePopup()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cerrar</button>
        </div>
    </div>

    <!-- Popup de Compra de Entradas -->
    <div id="purchasePopup" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
            <h3 class="text-2xl font-bold mb-4">Compra de Entradas</h3>
            <label class="block mb-2">Cantidad de Entradas:</label>
            <input type="number" id="ticketQuantity" min="1" class="border rounded w-full p-2 mb-4">
            <button onclick="purchaseTickets()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Comprar</button>
            <button onclick="closePopup()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-2">Cancelar</button>
        </div>
    </div>

    <!-- Scripts para Popups -->
    <script>
        function showEventDetails(eventId) {
            // Fetch details and display in the popup
            fetch(`/events/public/${eventId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('eventDetailsName').innerText = data.name;
                    document.getElementById('eventDetailsDescription').innerText = data.description;
                    document.getElementById('detailsPopup').classList.remove('hidden');
                });
        }

        function showPurchasePopup(eventId) {
            window.currentEventId = eventId;
            document.getElementById('purchasePopup').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('detailsPopup').classList.add('hidden');
            document.getElementById('purchasePopup').classList.add('hidden');
        }

        function purchaseTickets() {
            const quantity = document.getElementById('ticketQuantity').value;
            fetch(`/user/events/${window.currentEventId}/purchase`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                closePopup();
            })
            .catch(error => alert('Error al realizar la compra.'));
        }
    </script>
</x-app-layout>
