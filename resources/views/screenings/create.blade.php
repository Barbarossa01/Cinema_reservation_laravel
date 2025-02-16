@extends('layouts.app')

@section('content')

<h1>Dodaj seans</h1>

<!-- Form for Adding a New Screening -->
<form id="screeningForm" action="{{ route('screenings.store') }}" method="POST" class="form-container">
    @csrf

    <div class="form-group">
        <label for="date">Data:</label>
        <input type="date" name="date" id="date" required>
    </div>

    <div class="form-group">
        <label for="time">Godzina:</label>
        <input type="time" name="time" id="time" required>
    </div>

    <div class="form-group">
        <label for="hall">Hala:</label>
        <input type="text" name="hall" id="hall" required>
    </div>

    <div class="form-group">
        <label for="film_id">Film:</label>
        <select name="film_id" id="film_id" required>
            @foreach ($films as $film)
                <option value="{{ $film->id }}">{{ $film->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="available_seats">Dostępne miejsca:</label>
        <input type="number" name="available_seats" id="available_seats" 
               value="{{ old('available_seats', $defaultSeats ?? 0) }}" required>
    </div>

    <div class="form-group">
        <label for="price">Cena:</label>
        <input type="number" step="0.01" name="price" id="price" 
               value="{{ old('price', $defaultPrice ?? 0.00) }}" required>
    </div>

    <div class="form-group">
        <label for="screen_type">Typ ekranu:</label>
        <select name="screen_type" id="screen_type" required>
            <option value="2D" {{ old('screen_type') == '2D' ? 'selected' : '' }}>2D</option>
            <option value="3D" {{ old('screen_type') == '3D' ? 'selected' : '' }}>3D</option>
            <option value="IMAX" {{ old('screen_type') == 'IMAX' ? 'selected' : '' }}>IMAX</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn submit-btn">Dodaj seans</button>
        <a href="{{ route('screenings.index') }}" class="btn cancel-btn">Powrót do seansów</a>
    </div>
</form>

<script>
    document.getElementById('screeningForm').addEventListener('submit', function(event) {
        const dateInput = document.getElementById('date').value;
        const today = new Date();
        const selectedDate = new Date(dateInput);

        // Calculate the maximum date (1 year from today)
        const maxDate = new Date();
        maxDate.setFullYear(today.getFullYear() + 1);

        // Check if the selected date is in the future
        if (selectedDate <= today) {
            alert('Data musi być w przyszłości.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        // Check if the selected date is within one year
        if (selectedDate > maxDate) {
            alert('Data nie może być późniejsza niż jeden rok od dzisiaj.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

@endsection
