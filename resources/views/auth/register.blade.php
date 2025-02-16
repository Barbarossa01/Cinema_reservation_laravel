<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - Kino+ Cinema Network</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="welcome-page">
    @include('layouts.header') <!-- Include the shared header -->

    <!-- Main Content -->
    <main>
        <!-- Registration Section -->
        <section class="registration-section" style="text-align: center; padding: 50px;">
            <h1>Rejestracja</h1>
            <p>Utwórz konto, aby zarezerwować bilety i korzystać z naszego serwisu.</p>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" style="max-width: 400px; margin: 0 auto;">
                @csrf

                <!-- First Name -->
                <div style="margin-bottom: 15px;">
                    <input 
                        type="text" 
                        name="first_name" 
                        placeholder="Imię" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        required
                    >
                </div>

                <!-- Last Name -->
                <div style="margin-bottom: 15px;">
                    <input 
                        type="text" 
                        name="last_name" 
                        placeholder="Nazwisko" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        required
                    >
                </div>

                <!-- Email -->
                <div style="margin-bottom: 15px;">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        required
                    >
                </div>

                <!-- Password -->
                <div style="margin-bottom: 15px;">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Hasło" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        required
                    >
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 15px;">
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Potwierdź hasło" 
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        required
                    >
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        style="width: 100%; padding: 10px; background-color: #28A745; color: #fff; border: none; border-radius: 5px; cursor: pointer;"
                    >
                        Zarejestruj się
                    </button>
                </div>

                <!-- Error Display -->
                @if ($errors->any())
                    <div style="color: red; margin-top: 15px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>

            <!-- Redirect to Login -->
            <p style="margin-top: 20px;">Masz już konto? <a href="{{ route('login') }}" style="color: #007BFF;">Zaloguj się</a></p>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kino+ Cinema Network. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
