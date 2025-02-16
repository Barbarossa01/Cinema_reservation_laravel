@extends('layouts.app')

@section('content')

<h1>Screenings</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Czas</th>
            <th>Hala</th>
            <th>Film</th>
            <th>Dostępne miejsca</th>
            <th>Cena</th>
            <th>Typ ekranu</th>
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
                <td>{{ $screening->film->title }}</td>
                <td>{{ $screening->available_seats }}</td>
                <td>{{ $screening->price }}</td>
                <td>{{ $screening->screen_type }}</td>
                <td>
                    @if (auth()->check() && auth()->user()->isAdmin())
                        <div class="actions">
                            <a href="{{ route('screenings.edit', $screening->id) }}" class="btn edit-btn">Edytuj</a>
                            <form action="{{ route('screenings.destroy', $screening->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-btn" onclick="return confirm('Czy na pewno?')">Usuń</button>
                            </form>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
