@extends('layouts.app')

@section('title', 'Moje Rezerwacje')

@section('content')
    <h1>Moje Rezerwacje</h1>

    @if ($reservations->isEmpty())
        <p>Nie masz żadnych aktywnych rezerwacji.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Data</th>
                    <th>Godzina</th>
                    <th>Sala</th>
                    <th>Liczba miejsc</th>
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
                            <!-- Cancel Reservation Button -->
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Czy na pewno chcesz anulować tę rezerwację?')">
                                    Anuluj
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
