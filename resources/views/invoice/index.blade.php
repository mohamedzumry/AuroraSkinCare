<x-layouts.app>
    <div class="container mx-auto mt-10 max-w-[85rem]">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Invoices</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Invoices Table -->
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Treatment</th>
                    <th class="px-4 py-2 border">Treatment Price</th>
                    <th class="px-4 py-2 border">Tax</th>
                    <th class="px-4 py-2 border">Total Price</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr class="text-center">
                        <td class="px-4 py-2 border">{{ $invoice['id'] }}</td>
                        <td class="px-4 py-2 border">{{ $invoice['treatment_name'] }}</td>
                        <td class="px-4 py-2 border">{{ $invoice['treatment_price'] }}</td>
                        <td class="px-4 py-2 border">{{ $invoice['tax'] }}</td>
                        <td class="px-4 py-2 border">{{ $invoice['total'] }}</td>
                        <td class="px-4 py-2 border">{{ $invoice['status'] }}</td>
                        <td class="px-4 py-2 border flex gap-2 justify-center">
                            <a href="{{ route('invoice.show', $invoice['id']) }}">
                                <x-heroicon-o-eye class="w-7 h-7 p-1 text-white bg-black rounded-md" />
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">No Invoices found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

</x-layouts.app>
