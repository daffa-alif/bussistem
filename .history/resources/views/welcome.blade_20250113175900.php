<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOVA TERMINAL</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('data:image/jpeg;base64,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') no-repeat center center fixed;
            background-size: cover;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        nav .nav-buttons {
            display: flex;
            gap: 15px;
        }

        nav .nav-buttons a {
            text-decoration: none;
            padding: 10px 20px;
            font-weight: bold;
            color: #007bff;
            border: 2px solid #007bff;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        nav .nav-buttons a:hover {
            background: #007bff;
            color: white;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 70px);
            text-align: center;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .main-content h1 {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .main-content p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .main-content .btn-pesan {
            padding: 15px 40px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
        }

        .main-content .btn-pesan:hover {
            background-color: #0056b3;
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.8);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <nav>
        <div class="title">JOVA TERMINAL</div>
        <div class="nav-buttons">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </nav>

    <div class="main-content">
        <h1>Welcome to JOVA TERMINAL</h1>
        <p>Your trusted partner for bus travel.</p>
        <button class="btn-pesan" onclick="window.location.href='{{ route('register') }}'">Pesan Sekarang</button>
    </div>

</body>
</html>
