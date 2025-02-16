<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Header -->
    @include('layouts.header')

    <main>
        <section class="user-panel">
            <h1>Panel użytkownika</h1>

            <div class="reservation-history">
                <h2>Historia rezerwacji</h2>

                @if ($reservations->count())
                    <table class="reservation-table">
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Data</th>
                                <th>Godzina</th>
                                <th>Sala</th>
                                <th>Ilość miejsc</th>
                                <th>Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->screening->film->title }}</td>
                                    <td>{{ $reservation->screening->date }}</td>
                                    <td>{{ $reservation->screening->time }}</td>
                                    <td>{{ $reservation->screening->hall }}</td>
                                    <td>{{ $reservation->seats }}</td>
                                    <td>
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Czy na pewno chcesz usunąć tę rezerwację?')">
                                                Anuluj Rezerwację
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Brak rezerwacji do wyświetlenia.</p>
                @endif
            </div>

            <!-- Edit User Details -->
            <div class="edit-details">
                <h2>Edycja danych</h2>
                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('POST')

                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required>

                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" placeholder="Zmień hasło">

                    <label for="first_name">Imię:</label>
                    <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" required>

                    <label for="last_name">Nazwisko:</label>
                    <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" required>

                    <button type="submit">Zapisz zmiany</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kino+ Cinema Network. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
