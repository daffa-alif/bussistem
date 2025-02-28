<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOVA TERMINAL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 1s ease-in-out;
        }
        body {
            background: url('https://i.pinimg.com/originals/97/16/d3/9716d38f7b7f6bbd59f0f64249b3a9ee.gif') no-repeat center top;
            background-size: cover;
            background-attachment: scroll;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="bg-white bg-opacity-80 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="text-2xl font-bold text-gray-800">JOVA TERMINAL</div>

                <div class="lg:hidden">
                    <button onclick="toggleMenu()" class="text-gray-800 hover:text-blue-600 p-2 rounded-md focus:outline-none transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <div class="hidden lg:flex space-x-6">
                    <a href="{{ route('login') }}" class="text-gray-800 font-semibold hover:text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-800 font-semibold hover:text-blue-600">Register</a>
                </div>
            </div>

            <div id="mobileMenu" class="hidden lg:hidden">
                <div class="space-y-2">
                    <a href="{{ route('login') }}" class="block text-gray-800 font-semibold hover:bg-blue-100 px-4 py-2 rounded">Login</a>
                    <a href="{{ route('register') }}" class="block text-gray-800 font-semibold hover:bg-blue-100 px-4 py-2 rounded">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="flex flex-col items-center justify-center min-h-screen text-center text-white">
        <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 text-orange-600 tracking-wide animate-fadeIn">
            Welcome to JOVA TERMINAL
        </h1>
        <p class="text-lg lg:text-xl text-gray-200 italic mb-6 animate-fadeIn">
            Your trusted partner for bus travel.
        </p>
        <form action="{{ route('register') }}">
            <button class="px-6 py-2.5 text-white bg-green-500 rounded-full text-lg font-semibold hover:bg-green-600 transition">
                Explore
            </button>
        </form>
    </div>

    <!-- Bus Listing Section -->
    <div class="bg-white py-12 px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-4 animate-fadeIn">
            Our Travels
        </h2>
        <p class="text-center text-lg text-gray-600 mb-8 animate-fadeIn">
            We travel around Indonesia across the country
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($buses as $bus)
                <div class="bg-gray-100 rounded-lg shadow-md p-6">
                    <h3 class="text-2xl font-semibold text-gray-700">{{ $bus->nama_bus }}</h3>
                    <p class="mt-2 text-sm text-gray-500">Plate: {{ $bus->plat_nomor }}</p>
                    <p class="mt-2 text-sm text-gray-500">Capacity: {{ $bus->kapasitas }} seats</p>
                    @foreach($bus->busRute as $busRute)
                        <p class="mt-2 text-sm text-gray-500"><strong>Route:</strong> {{ $busRute->rute->asal }} - {{ $busRute->rute->tujuan }}</p>
                    @endforeach
                    @if ($bus->busKelas->isNotEmpty())
                        <p class="mt-2 text-sm text-gray-500"><strong>Class:</strong> {{ $bus->busKelas->first()->kelas->nama_kelas }}</p>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('pemesanan.create', ['bus_id' => $bus->id_bus]) }}" class="block text-center text-white bg-black px-6 py-2 rounded-full hover:bg-gray-800 transition">
                            Pesan Sekarang!
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
