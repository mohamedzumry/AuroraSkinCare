<x-layouts.app>
    <div class="container mx-auto mt-10 max-w-[85rem]">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Appointments</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('appointments.index') }}" method="GET" class="flex items-center gap-4 mb-6">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Filter by Date</label>
                <input type="date" id="date" name="date" value="{{ request('date') }}"
                    class="border rounded p-2 w-full">
            </div>

            <div>
                <label for="query" class="block text-sm font-medium text-gray-700">Search by Patient Name or
                    ID</label>
                <input type="text" id="query" name="query" placeholder="Enter name or ID"
                    value="{{ request('query') }}" class="border rounded p-2 w-full">
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter/Search</button>
            </div>
        </form>

        <!-- Appointments Table -->
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Doctor</th>
                    <th class="px-4 py-2 border">Patient Name</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Time</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                    <tr class="text-center">
                        <td class="px-4 py-2 border">{{ $appointment['id'] }}</td>
                        <td class="px-4 py-2 border">{{ $appointment['doctor'] }}</td>
                        <td class="px-4 py-2 border">{{ $appointment['patient_name'] }}</td>
                        <td class="px-4 py-2 border">{{ $appointment['date'] }}</td>
                        <td class="px-4 py-2 border">{{ $appointment['time'] }}</td>
                        <td class="px-4 py-2 border flex gap-2 justify-center">
                            <a href="{{ route('appointments.show', $appointment['id']) }}">
                                <x-heroicon-o-eye class="w-7 h-7 p-1 text-white bg-black rounded-md" />
                            </a>
                            <a href="{{ route('appointments.edit', $appointment['id']) }}">
                                <x-heroicon-o-pencil-square
                                    class="w-7 h-7 p-1 text-white bg-yellow-500 rounded-md hover:bg-yellow-600" />
                            </a>
                            <form action="{{ route('appointments.delete', $appointment['id']) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this appointment?')">
                                    <x-heroicon-o-trash
                                        class="w-7 h-7 p-1 text-white bg-red-500 rounded-md hover:bg-red-600" />
                                </button>
                            </form>
                            <a href="{{ route('invoice.create', $appointment['id']) }}">
                                <x-heroicon-o-plus-circle
                                    class="w-7 h-7 p-1 text-white bg-green-500 rounded-md hover:bg-green-600" />
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>



</x-layouts.app>
