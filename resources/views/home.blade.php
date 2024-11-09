<x-layouts.home>
    <div class="flex flex-col items-center mt-10">
        <h2 class="text-3xl font-bold text-gray-800">Welcome to Aurora Skin Care</h2>
        <div class="mt-6 space-x-4">
            <a href="{{ route('appointments.index') }}" class="px-6 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">View Appointments</a>
            <a href="{{ route('appointments.create') }}" class="px-6 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">Make Appointment</a>
        </div>
        <div class="mt-6 space-x-4">
            <a href="{{ route('invoice.index') }}" class="px-6 py-2 text-black bg-yellow-500 rounded-md hover:bg-yellow-600">View Invoices</a>
        </div>
    </div>
</x-layouts.home>
