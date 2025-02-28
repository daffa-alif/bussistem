<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOVA TERMINAL</title>
    <style>
        /* General styles */
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpyRN_qQXL3UuZShess5Z7bnjT-mPNX_0kvQ&s') no-repeat center center fixed;
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

        /* Responsive styling */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
            }

            nav .title {
                font-size: 20px;
                margin-bottom: 10px;
            }

            nav .nav-buttons {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            nav .nav-buttons a {
                width: 100%;
                text-align: center;
                padding: 12px 0;
                font-size: 16px;
            }

            .main-content h1 {
                font-size: 32px;
            }

            .main-content p {
                font-size: 16px;
            }

            .main-content .btn-pesan {
                padding: 10px 30px;
                font-size: 16px;
            }
        }

        @media (min-width: 769px) {
            nav .title {
                font-size: 28px;
            }

            nav .nav-buttons a {
                font-size: 18px;
                padding: 10px 25px;
            }

            .main-content h1 {
                font-size: 60px;
            }

            .main-content p {
                font-size: 24px;
            }

            .main-content .btn-pesan {
                padding: 15px 50px;
                font-size: 20px;
            }
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
