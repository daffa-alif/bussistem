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
                </ul>

                <a href="{{ route('logout') }}" class="flex items-center text-red-500 hover:text-red-600 hover:bg-red-100 py-2 px-4 rounded transition mt-8">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </a>
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
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-5 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-lg font-bold">Welcome to the Application</h1>
            @auth
            <a href="{{ route('logout') }}" class="flex items-center text-red-500 hover:text-red-600 hover:bg-red-100 py-2 px-4 rounded transition mt-8">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
            
            @endauth
        </div>
    </header>

    <!-- Layout Wrapper -->
    <div class="flex">
        <!-- Sidebar -->
        <nav class="bg-white shadow-md w-64 min-h-screen p-6 rounded-lg mt-4 ml-4">
            <ul class="space-y-4">
                <li><a href="{{ route('pemesanan.index') }}" class="block py-3 px-4 text-gray-700 hover:text-blue-600 hover:bg-blue-100 rounded-md transition">Dashboard</a></li>
                <li><a href="{{ route('pemesanan.create') }}" class="block py-3 px-4 text-gray-700 hover:text-blue-600 hover:bg-blue-100 rounded-md transition">Create Pemesanan</a></li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 bg-gray-50">
            <div class="bg-white p-6 rounded-lg shadow-md">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
@endif
