@if (auth()->user()->role === 'admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-100 text-gray-900">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-blue-900 to-blue-700 w-64 p-6 flex flex-col justify-between">
            <!-- Logo and Navigation -->
            <div>
                <h2 class="text-white text-2xl font-bold mb-8">TailAdmin</h2>
                <ul class="space-y-4">
                    <li><a href="{{ route('dashboard') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">dashboard</span> Dashboard</a>
                    </li>
                    <li><a href="{{ route('users.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">group</span> Users</a>
                    </li>
                    <li><a href="{{ route('bus.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">directions_bus</span> Bus</a>
                    </li>
                    <li><a href="{{ route('kelas.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">class</span> Kelas</a>
                    </li>
                    <li><a href="{{ route('rute.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">map</span> Rute</a>
                    </li>

                    <h2 class="text-white text-xl font-semibold mt-8 mb-4">Section 1</h2>
                    <li><a href="{{ route('bus_rute.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">swap_horiz</span> Bus Rute</a>
                    </li>
                    <li><a href="{{ route('harga.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">attach_money</span> Harga</a>
                    </li>
                    <li><a href="{{ route('jadwal.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">schedule</span> Jadwal</a>
                    </li>
                    <li><a href="{{ route('kursibus.index') }}" class="flex items-center text-white hover:bg-blue-800 py-3 px-4 rounded-md transition">
                        <span class="material-icons-outlined mr-3">event_seat</span> Kursi Bus</a>
                    </li>
                </ul>
            </div>

            <!-- Logout -->
            <div>
                <a href="{{ route('logout') }}" class="flex items-center text-red-400 hover:bg-red-600 hover:text-white py-3 px-4 rounded-md transition">
                    <span class="material-icons-outlined mr-3">logout</span> Logout
                </a>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center bg-white shadow-md p-6 rounded-md mb-6">
                <h1 class="text-xl font-bold text-gray-700">Welcome to the Admin Dashboard</h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md shadow transition">
                        Logout
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                @yield('content')
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
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md shadow transition">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </header>

    <!-- Layout Wrapper -->
    <div class="flex">
        <!-- Sidebar -->
        <nav class="bg-blue-800 text-white w-64 min-h-screen p-6">
            <ul class="space-y-4">
                <li><a href="{{ route('pemesanan.index') }}" class="block py-3 px-4 hover:bg-blue-700 rounded-md transition">Dashboard</a></li>
                <li><a href="{{ route('pemesanan.create') }}" class="block py-3 px-4 hover:bg-blue-700 rounded-md transition">Create Pemesanan</a></li>
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