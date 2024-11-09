<x-layouts.app>
    <div class="max-w-lg mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">

        <h2 class="text-xl font-semibold mb-5 text-md">Appointment : <span class="bg-yellow-500 rounded px-2">{{ $appointment['id'] }}</span></h2>

            <label for="date" class="block font-semibold">Date : {{ $appointment['date'] }}</label>
            
            <label for="time" class="block font-semibold">Time : {{ $appointment['time'] }}</label>

            <label for="time" class="block font-semibold">Doctor : {{ $appointment['doctor'] }}</label>

            <label for="patient_nic" class="block font-semibold">Patient NIC : {{ $appointment['patient_nic'] }}</label>

            <label for="patient_name" class="block font-semibold">Patient Name : {{ $appointment['patient_name'] }}</label>

            <label for="patient_email" class="block font-semibold">Patient Email : {{ $appointment['patient_email'] }}</label>
            
            <label for="patient_phone" class="block font-semibold">Patient Phone : {{ $appointment['patient_phone'] }}</label>

            <label for="patient_phone" class="block font-semibold">Paid Registration Fee : {{ $appointment['registration_fee'] }}</label>

        </form>
    </div>
</x-layouts.app>
