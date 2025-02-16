@extends('layouts.app')

@section('content')
<h1>Edytuj seans</h1>
<form method="POST" action="{{ route('screenings.update', $screening->id) }}">
    @csrf
    @method('PUT')

    <label for="date">Data:</label>
    <input type="date" id="date" name="date" value="{{ old('date', $screening->date) }}" required>

    <label for="time">Godzina:</label>
    <input type="time" id="time" name="time" value="{{ old('time', $screening->time) }}" required>

    <label for="hall">Hala:</label>
    <input type="text" id="hall" name="hall" value="{{ old('hall', $screening->hall) }}" required>

    <label for="film_id">Film:</label>
    <select id="film_id" name="film_id" required>
        @foreach ($films as $film)
            <option value="{{ $film->id }}" {{ old('film_id', $screening->film_id) == $film->id ? 'selected' : '' }}>
                {{ $film->title }}
            </option>
        @endforeach
    </select>

    <label for="available_seats">Dostępne miejsca:</label>
    <input type="number" id="available_seats" name="available_seats" value="{{ old('available_seats', $screening->available_seats) }}" required>

    <label for="price">Cena:</label>
    <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $screening->price) }}" required>

    <label for="screen_type">Typ ekranu:</label>
    <select id="screen_type" name="screen_type" required>
        <option value="2D" {{ old('screen_type', $screening->screen_type) == '2D' ? 'selected' : '' }}>2D</option>
        <option value="3D" {{ old('screen_type', $screening->screen_type) == '3D' ? 'selected' : '' }}>3D</option>
        <option value="IMAX" {{ old('screen_type', $screening->screen_type) == 'IMAX' ? 'selected' : '' }}>IMAX</option>
    </select>

    <button type="submit">Zapisz zmiany</button>
</form>
@endsection
