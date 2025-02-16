<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kino+ Cinema Network</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="welcome-page">
    @include('layouts.header') <!-- Include the shared header -->

    <!-- Main Content -->
    <main>
        <!-- Login Section -->
        <section class="login-section" style="text-align: center; padding: 50px;">
            <h1>Zaloguj się</h1>
            <p>Podaj swoje dane, aby uzyskać dostęp do konta.</p>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" style="max-width: 400px; margin: 0 auto;">
                @csrf

                <!-- Email Field -->
                <div style="margin-bottom: 15px;">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        required
                    >
                </div>

                <!-- Password Field -->
                <div style="margin-bottom: 15px;">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        required
                    >
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        style="width: 100%; padding: 10px; background-color: #007BFF; color: #fff; border: none; border-radius: 5px; cursor: pointer;"
                    >
                        Zaloguj sie
                    </button>
                </div>

                <!-- Error Display -->
                @if ($errors->any())
                    <div style="color: red; margin-top: 15px;">
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif
            </form>

            <!-- Optional Registration Link -->
            <p style="margin-top: 20px;">Nie masz konta? <a href="{{ route('register') }}" style="color: #007BFF;">Zarejestruj się</a></p>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kino+ Cinema Network. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
