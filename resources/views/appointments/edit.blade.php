<x-layouts.app>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">

        <h2 class="text-xl font-semibold">Update Appointment</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.update', $appointment['id']) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <label for="date" class="block font-semibold">Date:</label>
            <input type="date" id="date" name="date" value="{{ $appointment['date'] }}" required
                class="border rounded p-2 w-full">

            <label for="time" class="block font-semibold">Time:</label>
            <select id="time" name="time" class="border rounded p-2 w-full" required>
                <option value="">Select Time</option>
                @foreach ($slots as $time)
                    <option value="{{ $time }}" @if ($appointment['time'] === $time) selected @endif>
                        {{ $time }}</option>
                @endforeach
            </select>

            <label for="doctor" class="block font-semibold">Doctor:</label>
            <select id="doctor" name="doctor" class="border rounded p-2 w-full" required>
                <option value="">Select Doctor</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->name }}" @if ($appointment['doctor'] === $doctor->name) selected @endif>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>

            <label for="patient_nic" class="block font-semibold">Patient NIC:</label>
            <input type="text" id="patient_nic" name="patient_nic" value="{{ $appointment['patient_nic'] }}" required
                class="border rounded p-2 w-full">

            <label for="patient_name" class="block font-semibold">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" value="{{ $appointment['patient_name'] }}" required
                class="border rounded p-2 w-full">

            <label for="patient_email" class="block font-semibold">Patient Email:</label>
            <input type="email" id="patient_email" name="patient_email" value="{{ $appointment['patient_email'] }}" required
                class="border rounded p-2 w-full">

            <label for="patient_phone" class="block font-semibold">Patient Phone:</label>
            <input type="tel" id="patient_name" placeholder="0712345678" name="patient_phone"
                value="{{ $appointment['patient_phone'] }}" required class="border rounded p-2 w-full">

            <input type="number" id="registration_fee"  name="registration_fee" value=500 required hidden>

            <div class="flex justify-between px-4">
            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Update Appointment</button>
            <a href="{{ route('appointments.index') }}" class="bg-red-500 text-white rounded px-4 py-2">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.app>
