@if (auth()->user()->role === 'admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</head>
<body class="font-sans bg-gray-100 text-gray-900">

    <div class="flex flex-col h-screen">
        <!-- Navbar -->
        <nav class="flex items-center justify-between bg-white shadow-md px-6 py-4">
            <h1 class="text-xl font-bold text-gray-700">Admin</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 font-semibold">Admin</span>
                <div class="relative">
                    <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200">
                    <span class="absolute bottom-0 right-0 bg-green-500 w-3 h-3 rounded-full border-2 border-white"></span>
                </div>
            </div>
        </nav>

        <div class="flex flex-1">
            <!-- Sidebar -->
            <div class="bg-white shadow-md rounded-lg w-64 p-6 mt-4 ml-4">
                <ul class="space-y-4">
                    <li><a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard</a>
                    </li>
                    <li><a href="{{ route('users.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-users mr-3"></i> Users</a>
                    </li>
                    <li><a href="{{ route('bus.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-bus mr-3"></i> Bus</a>
                    </li>
                    <li><a href="{{ route('kelas.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-graduation-cap mr-3"></i> Kelas</a>
                    </li>
                    <li><a href="{{ route('rute.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-map-marker-alt mr-3"></i> Rute</a>
                    </li>
            
                    <h2 class="text-gray-600 text-lg font-semibold mt-6">Section 1</h2>
                    <li><a href="{{ route('bus_rute.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-exchange-alt mr-3"></i> Bus Rute</a>
                    </li>
                    <li><a href="{{ route('harga.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-dollar-sign mr-3"></i> Harga</a>
                    </li>
                    <li><a href="{{ route('jadwal.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-calendar-alt mr-3"></i> Jadwal</a>
                    </li>
                    <li><a href="{{ route('kursibus.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-chair mr-3"></i> Kursi Bus</a>
                    </li>
                    <li><a href="{{ route('pemesanan.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-shopping-cart mr-3"></i> Pemesanan</a>
                    </li>
                    <!-- New Bus Kelas Link -->
                    <li><a href="{{ route('bus-kelas.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                        <i class="fas fa-layer-group mr-3"></i> Bus Kelas</a>
                    </li>
                </ul>
            
                <form action="{{ route('logout') }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit" class="flex items-center text-red-500 hover:text-red-600 hover:bg-red-100 py-2 px-4 rounded transition">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
            

            <!-- Main content -->
            <div class="flex-1 p-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>
</html>

@else
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <style>
        /* Animation for fading in and out the placeholder text */
        @keyframes fadeInOut {
            0% {
                opacity: 0;
            }
            25% {
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        /* Apply the animation to the placeholder text */
        .search-placeholder {
            animation: fadeInOut 3.5s ease-in-out infinite;
        }

        /* Animation for fading in and out of the input text */
        .fade-text {
            animation: fadeInOut 3.5s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-sans bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="flex items-center justify-between bg-white shadow-md px-6 py-4">
        <!-- Desktop Navigation Links -->
        <div class="flex items-center space-x-6 hidden md:flex">
            <a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a href="{{ route('pemesanan.index') }}" class="flex items-center text-gray-700 hover:text-blue-600 hover:bg-blue-100 py-2 px-4 rounded transition">
                <i class="fas fa-shopping-cart mr-3"></i> Pemesanan
            </a>
        </div>
        
        <!-- Search Bar and Collapse Button (Mobile view) -->
        <div class="flex items-center justify-center w-full md:w-1/3">
            <form action="{{ route('search') }}" method="GET" class="flex items-center bg-gray-100 rounded-md shadow-inner px-4 py-2 w-full">
                <i class="fas fa-search text-gray-400"></i>
                <input 
                    type="text" 
                    name="search"
                    id="searchInput"
                    placeholder="Search..." 
                    class="bg-transparent focus:outline-none ml-2 text-gray-600 w-full fade-text"
                    required
                    onfocus="this.placeholder = 'Search: bus, search: rute';">
            </form>
        </div>
        
        <!-- Collapse Button for Mobile View -->
        <button id="menuButton" class="md:hidden text-gray-700 font-bold px-4 py-2 border rounded-md ml-2">
            <i class="fas fa-bars"></i>
        </button>
    
        <!-- User Profile and Logout (Desktop view as dropdown) -->
        <div class="flex items-center space-x-4 hidden md:flex">
            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profileButton" class="flex items-center space-x-2 text-gray-700">
                    @if(Auth::check())
                                            <img src="data:image/jpeg;base64,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" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200">
                        <span class="text-gray-700 font-semibold">{{ Auth::user()->nama }}</span>
                    @else
                        <span class="text-gray-700 font-semibold">Guest</span>
                        <img src="https://via.placeholder.com/40" alt="" class="w-10 h-10 rounded-full border-2 border-gray-200">
                    @endif
                </button>
                
    
                <!-- Dropdown Menu (hidden by default) -->
                <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white shadow-md rounded-md hidden">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-gray-700 hover:text-red-700 py-2 px-4 rounded-md">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <script>
        // Wait for DOM content to fully load before attaching event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown Toggle
            const profileButton = document.getElementById('profileButton');
            const profileDropdown = document.getElementById('profileDropdown');
            
            if (profileButton) {
                profileButton.addEventListener('click', function() {
                    // Toggle the dropdown visibility
                    profileDropdown.classList.toggle('hidden');
                });
            }

            // Mobile menu toggle
            const menuButton = document.getElementById('menuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (menuButton) {
                menuButton.addEventListener('click', function() {
                    // Toggle the mobile menu visibility
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>

    <!-- Mobile Dropdown Menu (hidden by default) -->
    <div id="mobileMenu" class="md:hidden flex-col bg-white shadow-md absolute top-16 right-0 w-full p-4 z-10 hidden space-y-4">
        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 py-2 px-4 rounded transition block">Dashboard</a>
        <a href="{{ route('pemesanan.index') }}" class="text-gray-700 hover:text-blue-600 py-2 px-4 rounded transition block">Pemesanan</a>
        <form action="{{ route('logout') }}" method="POST" class="block">
            @csrf
            <button type="submit" class="text-gray-700 hover:text-red-700 py-2 px-4 rounded transition block">Logout</button>
        </form>
    </div>

    <main class="flex-1 p-6 bg-gray-50">
        <div class="bg-white p-6 rounded-lg shadow-md">
            @yield('content')
        </div>
    </main>

    <script>
        // Array of placeholder text to switch between
        const placeholders = ['Search: bus', 'Search: rute'];
        let placeholderIndex = 0;

        // Function to change the placeholder text every 3.5 seconds
        function changePlaceholderText() {
            const searchInput = document.getElementById('searchInput');
            searchInput.placeholder = placeholders[placeholderIndex];
            placeholderIndex = (placeholderIndex + 1) % placeholders.length;
        }

        // Start changing the placeholder text every 3.5 seconds
        setInterval(changePlaceholderText, 3500);

        // Enable input after the animation starts
        setTimeout(() => {
            document.getElementById('searchInput').disabled = false;
        }, 3500);
    </script>

</body>
</html>


@endif
