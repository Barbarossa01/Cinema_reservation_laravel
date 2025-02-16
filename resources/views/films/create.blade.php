@extends('layouts.app')

@section('title', 'Dodaj Nowy Film')

@section('content')
    <section class="create-film">
        <h1>Dodaj Nowy Film</h1>
        <form method="POST" action="{{ route('films.store') }}" enctype="multipart/form-data" class="form-container">
            @csrf

            <table class="form-table">
                <tr>
                    <td><label for="title">Tytuł:</label></td>
                    <td><input type="text" name="title" id="title" required></td>
                </tr>
                <tr>
                    <td><label for="description">Opis:</label></td>
                    <td><textarea name="description" id="description"></textarea></td>
                </tr>
                <tr>
                    <td><label for="category">Kategoria:</label></td>
                    <td><input type="text" name="category" id="category" required></td>
                </tr>
                <tr>
                    <td><label for="duration">Czas trwania (minuty):</label></td>
                    <td><input type="number" name="duration" id="duration" required></td>
                </tr>
                <tr>
                    <td><label for="image">Obraz:</label></td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
            </table>

            <div class="form-actions">
    <button type="submit" class="btn colorful-btn">Zapisz</button>
    <a href="{{ route('films.index') }}" class="btn colorful-btn-secondary">Anuluj</a>
</div>

        </form>
    </section>
@endsection
