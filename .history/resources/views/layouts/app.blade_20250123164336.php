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
                        <span class="text-gray-700 font-semibold">{{ Auth::user()->nama }}</span>
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200">
                    @else
                        <span class="text-gray-700 font-semibold">Guest</span>
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200">
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
        // Toggle the profile dropdown
        document.getElementById('profileButton').addEventListener('click', () => {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');  // Toggle visibility of the dropdown
        });
    
        // Mobile menu toggle
        document.getElementById('menuButton').addEventListener('click', () => {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');  // Show or hide the menu
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

        // Mobile menu toggle
        document.getElementById('menuButton').addEventListener('click', () => {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');  // Show or hide the menu
        });
    </script>

</body>
</html>

@endif
