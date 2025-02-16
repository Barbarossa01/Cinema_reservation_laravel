@extends('layouts.app')

@section('content')
<div class="reservation-container">
    <h1 class="reservation-title">
        Zarezerwuj miejsca na <span class="film-title">{{ $screening->film->title }}</span>
    </h1>

    <form action="{{ route('reservations.store', $screening->id) }}" method="POST" class="reservation-form">
        @csrf

        <table class="reservation-table">
            <tr>
                <td class="form-label">
                    <label for="seats">Liczba miejsc:</label>
                </td>
                <td>
                    <input 
                        type="number" 
                        name="seats" 
                        id="seats" 
                        class="form-input" 
                        min="1" 
                        max="{{ $screening->available_seats }}" 
                        placeholder="Wybierz liczbę miejsc" 
                        required>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="form-actions">
                    <button type="submit" class="btn btn-primary">Zarezerwuj teraz</button>
                    <a href="{{ route('films.index') }}" class="btn btn-secondary">Powrót do filmów</a>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection
