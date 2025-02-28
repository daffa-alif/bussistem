<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 2.5em;
            background-color: #171717;
            border-radius: 25px;
            transition: 0.4s ease-in-out;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .form:hover {
            transform: scale(1.05);
            border: 1px solid black;
        }

        #heading {
            text-align: center;
            margin: 1em 0;
            color: rgb(255, 255, 255);
            font-size: 1.8em;
            font-weight: bold;
        }

        .field {
            display: flex;
            align-items: center;
            gap: 0.5em;
            border-radius: 25px;
            padding: 0.6em;
            background-color: #252525;
            box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
        }

        .input-icon {
            height: 1.3em;
            width: 1.3em;
            fill: white;
        }

        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: #d3d3d3;
        }

        .btn {
            display: flex;
            justify-content: center;
            margin-top: 2.5em;
        }

        .button1 {
            padding: 0.7em 3em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: 0.4s ease-in-out;
            background-color: #252525;
            color: white;
        }

        .button1:hover {
            background-color: black;
            color: white;
        }

        .button3 {
            margin-top: 1.5em;
            padding: 0.7em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: 0.4s ease-in-out;
            background-color: #252525;
            color: white;
            width: 100%;
            text-align: center;
        }

        .button3:hover {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-900 flex justify-center items-center min-h-screen">
    <form class="form w-96 sm:w-[30rem]" action="{{ route('login') }}" method="POST">
        @csrf

        <p id="heading">Login</p>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10 2H4v1h8V4z"/>
            </svg>
            <input autocomplete="off" placeholder="Email" name="email" id="email" class="input-field" type="email" value="{{ old('email') }}" required>
        </div>

        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
            </svg>
            <input placeholder="Password" name="password" id="password" class="input-field" type="password" required>
        </div>

        <div class="btn">
            <button type="submit" class="button1">Login</button>
        </div>

        <button type="button" onclick="window.location.href='{{ route('register') }}'" class="button3">Sign Up</button>
    </form>
</body>
</html>
