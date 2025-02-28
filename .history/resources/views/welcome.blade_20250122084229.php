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

        .button {
  width: 110px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 10px;
  background-color: rgb(161, 255, 20);
  border-radius: 30px;
  color: rgb(19, 19, 19);
  font-weight: 600;
  border: none;
  position: relative;
  cursor: pointer;
  transition-duration: .2s;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.116);
  padding-left: 8px;
  transition-duration: .5s;
}

.svgIcon {
  height: 25px;
  transition-duration: 1.5s;
}

.bell path {
  fill: rgb(19, 19, 19);
}

.button:hover {
  background-color: rgb(192, 255, 20);
  transition-duration: .5s;
}

.button:active {
  transform: scale(0.97);
  transition-duration: .2s;
}

.button:hover .svgIcon {
  transform: rotate(250deg);
  transition-duration: 1.5s;
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
                        onclick="toggleMenu()".button {
                            width: 110px;
                            height: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: flex-start;
                            gap: 10px;
                            background-color: rgb(161, 255, 20);
                            border-radius: 30px;
                            color: rgb(19, 19, 19);
                            font-weight: 600;
                            border: none;
                            position: relative;
                            cursor: pointer;
                            transition-duration: .2s;
                            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.116);
                            padding-left: 8px;
                            transition-duration: .5s;
                          }
                          
                          .svgIcon {
                            height: 25px;
                            transition-duration: 1.5s;
                          }
                          
                          .bell path {
                            fill: rgb(19, 19, 19);
                          }
                          
                          .button:hover {
                            background-color: rgb(192, 255, 20);
                            transition-duration: .5s;
                          }
                          
                          .button:active {
                            transform: scale(0.97);
                            transition-duration: .2s;
                          }
                          
                          .button:hover .svgIcon {
                            transform: rotate(250deg);
                            transition-duration: 1.5s;
                          }
                          
                          
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
        <h1 class="text-4xl lg:text-6xl font-bold mb-4 shadow-lg text-orange-600">Welcome to JOVA TERMINAL</h1>
        <p class="text-lg lg:text-2xl mb-6 shadow-lg">Your trusted partner for bus travel.</p>
        <button class="button">
            <svg class="svgIcon" viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg"             onclick="window.location.href='{{ route('register') }}'"
            ><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm50.7-186.9L162.4 380.6c-19.4 7.5-38.5-11.6-31-31l55.5-144.3c3.3-8.5 9.9-15.1 18.4-18.4l144.3-55.5c19.4-7.5 38.5 11.6 31 31L325.1 306.7c-3.2 8.5-9.9 15.1-18.4 18.4zM288 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"></path></svg>
           Explore
         </button>
         
    </div>

</body>
</html>
