@extends('layouts.app')
@section('content')
<h1>Edit Film</h1>
<form method="POST" action="{{ route('films.update', $film) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <table>
        <tr>
            <td><label for="title">Tytuł:</label></td>
            <td><input type="text" name="title" value="{{ $film->title }}" required></td>
        </tr>
        <tr>
            <td><label for="description">Opis:</label></td>
            <td><textarea name="description">{{ $film->description }}</textarea></td>
        </tr>
        <tr>
            <td><label for="category">Kategoria:</label></td>
            <td><input type="text" name="category" value="{{ $film->category }}" required></td>
        </tr>
        <tr>
            <td><label for="duration">Czas trwania (minuty):</label></td>
            <td><input type="number" name="duration" value="{{ $film->duration }}" required></td>
        </tr>
        <tr>
            <td><label for="image">Zdjęcie:</label></td>
            <td>
                <input type="file" name="image">
                @if ($film->image)
                    <img src="{{ asset('storage/' . $film->image) }}" alt="Obraz filmu" width="100">
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">Zapisz zmiany</button></td>
        </tr>
    </table>
</form>
@endsection