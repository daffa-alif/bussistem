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
                        <img src="data:image/jpeg;base64,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" alt="" class="w-10 h-10 rounded-full border-2 border-gray-200">
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
