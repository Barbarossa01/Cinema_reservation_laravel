<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kino+ Cinema Network</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* Additional Styles */
        body.welcome-page {
            background: linear-gradient(to right, #0073e6, #28a745);
            color: white;
        }

        section {
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        #home {
            background: rgba(0, 0, 0, 0.5);
            padding: 50px 20px;
            color: #f9f9f9;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }

        #repertoire {
            background: #fff;
            color: #333;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #repertoire button {
            background: #0073e6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
        }

        #repertoire button:hover {
            background: #005bb5;
        }

        #features {
            background: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .feature {
            background: #fff;
            flex: 1 1 30%;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        .feature img {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        footer {
            margin-top: auto;
            padding: 10px;
            background: #0073e6;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body class="welcome-page">
    <!-- Shared Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section id="home">
            <h1>Witamy w Kino+ Cinema Network</h1>
            <p>Przeglądaj filmy, rezerwuj bilety i ciesz się wyjątkowymi wydarzeniami kinowymi.</p>
            <a href="{{ route('register') }}">
                <button>Zarejestruj się teraz</button>
            </a>
        </section>

        <!-- Repertoire Section -->
        <section id="repertoire">
            <h2>Repertuar</h2>
            <p>Odkryj nasz repertuar pełen emocji i rozrywki!</p>
            <a href="{{ route('films.index') }}">
                <button>Przeglądaj repertuar</button>
            </a>
        </section>

        <!-- Features Section -->
        <section id="features">
            <div class="feature">
                <img src="{{ asset('images/popcorn.jpg') }}" alt="Popcorn">
                <h3>Wyjątkowe Przekąski</h3>
                <p>Skosztuj naszych świeżych przekąsek, od klasycznego popcornu po nowoczesne smaki!</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/cinema.jpg') }}" alt="Sala kinowa">
                <h3>Komfortowe Sale</h3>
                <p>Ciesz się filmami w wygodnych fotelach z doskonałą jakością dźwięku i obrazu.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/3d.jpg') }}" alt="3D">
                <h3>Filmy 3D i IMAX</h3>
                <p>Przeżyj niesamowite wrażenia dzięki naszym filmom w technologii 3D i IMAX.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kino+ Cinema Network. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
