@php
    $today = now()->format('Y-m-d');
    $maxDate = now()->addMonth()->format('Y-m-d');
@endphp
<x-layouts.app>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">

        <div class="bg-green-100 p-4 mb-4 rounded">
            <p class="text-lg font-semibold">Open Times:</p>
            <p class="text-lg">Monday : 10:00 AM to 1:00 PM</p>
            <p class="text-lg">Wednesday : 2:00 PM to 5:00 PM</p>
            <p class="text-lg">Friday : 4:00 PM to 8:00 PM</p>
            <p class="text-lg">Saturday : 9:00 AM to 1:00 PM</p>
        </div>

        <h2 class="text-xl font-semibold">Create Appointment</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" class="space-y-4">
            @csrf

            <label for="date" class="block font-semibold">Date:</label>
            <input type="date" id="date" name="date" min="{{ $today }}" max="{{ $maxDate }}"
                value="{{ old('date') }}" required class="border rounded p-2 w-full">

            <label for="time" class="block font-semibold">Time:</label>
            <select id="time" name="time" class="border rounded p-2 w-full" required>
                <option value="">Select Time</option>
                @foreach ($slots as $time)
                    <option value="{{ $time }}" @if (old('time') === $time) selected @endif>
                        {{ $time }}</option>
                @endforeach
            </select>

            <label for="doctor" class="block font-semibold">Doctor:</label>
            <select id="doctor" name="doctor" class="border rounded p-2 w-full" required>
                <option value="">Select Doctor</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->name }}" @if (old('doctor') === $doctor->name) selected @endif>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>

            <label for="patient_nic" class="block font-semibold">Patient NIC:</label>
            <input type="text" id="patient_nic" name="patient_nic" value="{{ old('patient_nic') }}" required
                class="border rounded p-2 w-full">

            <label for="patient_name" class="block font-semibold">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" value="{{ old('patient_name') }}" required
                class="border rounded p-2 w-full">

            <label for="patient_email" class="block font-semibold">Patient Email:</label>
            <input type="email" id="patient_email" name="patient_email" value="{{ old('patient_email') }}" required
                class="border rounded p-2 w-full">

            <label for="patient_phone" class="block font-semibold">Patient Phone:</label>
            <input type="tel" id="patient_name" placeholder="0712345678" name="patient_phone"
                value="{{ old('patient_phone') }}" required class="border rounded p-2 w-full">

            <label for="registration_fee" class="block font-semibold">Registration Fee:</label>
            <input type="number" id="registration_fee" class="border rounded p-2 w-full" name="registration_fee"
                value=500 required disabled>

            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Book Appointment</button>
        </form>
    </div>
</x-layouts.app>
