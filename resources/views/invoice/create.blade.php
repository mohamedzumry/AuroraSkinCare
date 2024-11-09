<x-layouts.app>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">

        <h2 class="text-xl font-semibold">Create Invoice for Appointment  <span class="bg-yellow-500 rounded px-2">{{ $appointment['id'] }}</span></h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('invoice.store') }}" class="space-y-4" method="POST">
            @csrf

            <label for="treatmentName" class="block font-semibold">Treatment:</label>
            <select id="treatmentName" name="treatmentName" class="border rounded p-2 w-full" required>
                <option value="">Select Treatment</option>
                @foreach ($treatments as $name => $price)
                    <option value="{{ $name }}" @if (old('treatmentName') === $name) selected @endif>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            <input type="number" id="tax" name="tax" value=2.5 required hidden>
            <input type="string" id="status" name="status" value="Paid" required hidden>
            <input type="number" id="appointmentId" name="appointmentId" value={{ $appointment['id'] }} required hidden>

            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Create Invoice</button>
        </form>
    </div>
</x-layouts.app>
