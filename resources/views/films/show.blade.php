<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $film->title }} - Szczegóły</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include('layouts.header')

    <main>
        <section class="film-details">
            <h1>{{ $film->title }}</h1>
            <img src="{{ $film->image ? asset('images/' . $film->image) : asset('images/placeholder.jpg') }}" alt="{{ $film->title }}">
            <p><strong>Opis:</strong> {{ $film->description }}</p>
            <p><strong>Kategoria:</strong> {{ $film->category }}</p>
            <p><strong>Czas trwania:</strong> {{ intdiv($film->duration, 60) }} godz. {{ $film->duration % 60 }} min</p>

            <h2>Seanse</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Sala</th>
                        <th>Dostępne miejsca</th> 
                        <th>Cena</th> 
                        <th>Akcja</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($screenings as $screening)
                        <tr>
                            <td>{{ $screening->id }}</td>
                            <td>{{ $screening->date }}</td>
                            <td>{{ $screening->time }}</td>
                            <td>{{ $screening->hall }}</td>
                            <td>{{ $screening->available_seats }}</td> 
                            <td>{{ number_format($screening->price, 2) }} zł</td> 
                            <td>
                                <!-- Reserve Button -->
                                <form action="{{ route('reservations.create', ['screening' => $screening->id]) }}" method="GET" style="margin-top: 10px;">
                <button type="submit" class="btn reserve-btn">Zarezerwuj bilet</button>
            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Kino+ Cinema Network. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
