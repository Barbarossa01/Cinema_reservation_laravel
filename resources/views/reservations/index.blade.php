@extends('layouts.app')

@section('title', 'Lista Rezerwacji')

@section('content')
    <h1>Lista Rezerwacji</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Użytkownik</th>
                <th>Film</th>
                <th>Data</th>
                <th>Godzina</th>
                <th>Miejsca</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->user->email }}</td>
                    <td>{{ $reservation->screening->film->title }}</td>
                    <td>{{ $reservation->screening->date }}</td>
                    <td>{{ $reservation->screening->time }}</td>
                    <td>{{ $reservation->seats }}</td>
                    <td>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę rezerwację?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete-btn">Usuń</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Brak rezerwacji.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
