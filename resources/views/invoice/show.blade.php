<x-layouts.app>
    <div class="max-w-lg mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">

        <h2 class="text-xl font-semibold mb-5">
            Invoice No : <span class="bg-yellow-500 rounded px-2">{{ $invoice['id'] }}</span>
        </h2>
        <h3 class="text-lg font-semibold mb-3">Invoice Date : {{ $invoice['created_time'] }}</h3>

        <h3 class="text-lg font-semibold mb-3">Appointment Details</h3>
        <table class="border-collapse w-full mb-5">
            <tr>
                <th class="border px-4 py-2 text-left">Appointment Date</th>
                <td class="border px-4 py-2">{{ $invoice['appointment_date'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Appointment Time</th>
                <td class="border px-4 py-2">{{ $invoice['appointment_time'] }}</td>
            </tr>
        </table>

        <h3 class="text-lg font-semibold mb-3">Patient Details</h3>
        <table class="border-collapse w-full mb-5">
            <tr>
                <th class="border px-4 py-2 text-left">Patient NIC</th>
                <td class="border px-4 py-2">{{ $invoice['patient_nic'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Patient Name</th>
                <td class="border px-4 py-2">{{ $invoice['patient_name'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Patient Email</th>
                <td class="border px-4 py-2">{{ $invoice['patient_email'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Patient Phone</th>
                <td class="border px-4 py-2">{{ $invoice['patient_phone'] }}</td>
            </tr>
        </table>

        <h3 class="text-lg font-semibold mb-3">Treatment Details</h3>
        <table class="border-collapse w-full mb-5">
            <tr>
                <th class="border px-4 py-2 text-left">Treatment Name</th>
                <td class="border px-4 py-2">{{ $invoice['treatment_name'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Treatment Price</th>
                <td class="border px-4 py-2">{{ $invoice['treatment_price'] }}</td>
            </tr>
            
        </table>

        <h3 class="text-lg font-semibold mb-3">Payment Details</h3>
        <table class="border-collapse w-full">
            <tr>
                <th class="border px-4 py-2 text-left">Registration Fee</th>
                <td class="border px-4 py-2">{{ $invoice['registration_fee'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Treatment Price</th>
                <td class="border px-4 py-2">{{ $invoice['treatment_price'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Tax Percentage</th>
                <td class="border px-4 py-2">{{ $invoice['tax'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Total</th>
                <td class="border px-4 py-2">{{ $invoice['total'] }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2 text-left">Status</th>
                <td class="border px-4 py-2">{{ $invoice['status'] }}</td>
            </tr>
        </table>

    </div>
</x-layouts.app>
