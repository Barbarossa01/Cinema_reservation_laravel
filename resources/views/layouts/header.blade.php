<header>
    <div class="logo">
        <img src="{{ asset('images/logo.webp') }}" alt="Kino+ Logo">
    </div>
    <nav>
        <ul class="menu">
            <li><a href="{{ url('/') }}">Strona główna</a></li>
            <li><a href="{{ route('films.index') }}">Repertuar</a></li>

            @auth
                @if (auth()->user()->isAdmin())
                    <!-- Administrator-only Links -->
                    <li><a href="{{ route('films.create') }}">Dodaj Film</a></li>
                    <li><a href="{{ route('screenings.index') }}">Lista Seansów</a></li>
                    <li><a href="{{ route('screenings.create') }}">Dodaj Seans</a></li>
                    <li><a href="{{ route('reservations.index') }}">Lista Rezerwacji</a></li>
                @endif

                <!-- Moje Konto for All Logged-in Users -->
                <li><a href="{{ route('user.profile') }}">Moje Konto</a></li>

                <!-- Logout Option Styled as Button -->
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="nav-button">Wyloguj</button>
                    </form>
                </li>
            @else
                <!-- Links for Guests -->
                <li><a href="{{ route('login') }}">Zaloguj się</a></li>
                <li><a href="{{ route('register') }}">Zarejestruj się</a></li>
            @endauth

            <li><a href="{{ route('pages.about') }}">O nas</a></li>
            <li><a href="{{ route('pages.contact') }}">Kontakt</a></li>
        </ul>
    </nav>
</header>
