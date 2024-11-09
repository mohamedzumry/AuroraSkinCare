<!-- Navigation Header -->
<header class="bg-gray-800 p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo Section -->
        <div class="text-white text-xl font-bold">
            <a href="/" class="hover:text-gray-300">Aurora Skin Care</a>
        </div>

        <!-- Navigation Links -->
        <nav class="space-x-8 flex items-center">
            <a href="{{ route('home') }}" class="text-white hover:text-gray-300">Home</a>

            <!-- Appointments Dropdown -->
            <div class="relative group">
                <button class="text-white hover:text-gray-300 focus:outline-none">
                    Appointments
                </button>
                <div class="absolute hidden group-hover:block bg-gray-700 rounded shadow-lg right-0 min-w-max">
                    <a href="{{ route('appointments.index') }}" class="block px-4 py-2 text-white hover:bg-gray-600">View All</a>
                    <a href="{{ route('appointments.create') }}" class="block px-4 py-2 text-white hover:bg-gray-600">Create New</a>
                </div>
            </div>

            <!-- Invoice Dropdown -->
            <div class="relative group">
                <button class="text-white hover:text-gray-300 focus:outline-none">
                    Invoice
                </button>
                <div class="absolute hidden group-hover:block bg-gray-700 rounded shadow-lg right-0 min-w-max">
                    <a href="{{ route('invoice.index') }}" class="block px-4 py-2 text-white hover:bg-gray-600">View All</a>
                </div>
            </div>
        </nav>
    </div>
</header>
