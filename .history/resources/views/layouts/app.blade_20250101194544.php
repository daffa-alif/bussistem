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
        <div class="bg-blue-900 w-64 p-6">
            <h2 class="text-white text-2xl font-bold mb-8">Admin Panel</h2>
            <ul class="space-y-4">
                <li><a href="{{ route('dashboard') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Dashboard</a></li>
                <li><a href="{{ route('users.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Users</a></li>
                <li><a href="{{ route('bus.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Bus</a></li>
                <li><a href="{{ route('kelas.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Kelas</a></li>
                <li><a href="{{ route('rute.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Rute</a></li>

                <h2 class="text-white text-xl font-semibold mb-4 mt-8">Section 1</h2>
                <li><a href="{{ route('bus_rute.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Bus Rute</a></li>
                <li><a href="{{ route('harga.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Harga</a></li>
                <li><a href="{{ route('jadwal.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Jadwal</a></li>
                <li><a href="{{ route('kursibus.index') }}" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Kursi Bus</a></li>

                <li><a href="#" class="text-white hover:bg-blue-700 py-3 px-4 rounded-md block transition">Settings</a></li>
                <li><a href="{{ route('logout') }}" class="text-white hover:bg-red-600 py-3 px-4 rounded-md block transition">Logout</a></li>
            </ul>
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
