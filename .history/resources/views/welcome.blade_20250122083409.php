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

            // Add animation classes
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('animate-slide-down');
                menu.classList.remove('animate-slide-up');
            } else {
                menu.classList.add('animate-slide-up');
                menu.classList.remove('animate-slide-down');
            }
        }
    </script>
    <style>
        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        .animate-slide-down {
            animation: slideDown 0.3s ease-out forwards;
        }

        .animate-slide-up {
            animation: slideUp 0.3s ease-in forwards;
        }
    </style>
</head>
<body class="bg-cover bg-center" style="background-image: url('https://i.pinimg.com/originals/97/16/d3/9716d38f7b7f6bbd59f0f64249b3a9ee.gif');">

    <!-- Navbar -->
    <nav class="bg-white bg-opacity-80 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo/Title -->
                <div class="text-2xl font-bold text-gray-800">
                    JOVA TERMINAL
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button 
                        id="menuButton" 
                        class="text-gray-800 hover:text-blue-600 hover:bg-gray-100 p-2 rounded-md focus:outline-none transition duration-300" 
                        onclick="toggleMenu()"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden lg:flex space-x-6">
                    <a href="{{ route('login') }}" class="text-gray-800 font-semibold hover:text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-800 font-semibold hover:text-blue-600">Register</a>
                </div>
            </div>

            <!-- Collapsible Menu (Mobile) -->
            <div id="mobileMenu" class="hidden lg:hidden">
                <div class="space-y-2">
                    <a href="{{ route('login') }}" class="block text-gray-800 font-semibold hover:bg-blue-100 px-4 py-2 rounded">Login</a>
                    <a href="{{ route('register') }}" class="block text-gray-800 font-semibold hover:bg-blue-100 px-4 py-2 rounded">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex flex-col items-center justify-center min-h-screen text-center text-white">
        <h1 class="text-4xl lg:text-6xl font-bold mb-4 shadow-lg text--600">Welcome to JOVA TERMINAL</h1>
        <p class="text-lg lg:text-2xl mb-6 shadow-lg">Your trusted partner for bus travel.</p>
        <button 
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition transform hover:scale-105"
            onclick="window.location.href='{{ route('register') }}'"
        >
            Pesan Sekarang
        </button>
    </div>

</body>
</html>
