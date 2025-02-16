@extends('layouts.app')

@section('title', 'Repertuar')

@section('content')
    <!-- Filter Section -->
    <section class="filter-section">
        <h1>Repertuar</h1>
        <form class="filter-form">
            <label for="genre">Wybierz gatunek:</label>
            <select id="genre">
                <option value="all">Wszystkie</option>
                <option value="akcja">Akcja</option>
                <option value="komedia">Komedia</option>
                <option value="drama">Drama</option>
                <option value="horror">Horror</option>
            </select>
        </form>
    </section>

    <!-- Movies List -->
    <section class="movies-list" id="movies-list">
        @forelse ($films as $film)
            <div class="movie" data-category="{{ strtolower($film->category) }}">
                <img src="{{ $film->image ? asset('images/' . $film->image) : asset('images/placeholder.jpg') }}" alt="{{ $film->title }}">

                <div class="movie-details">
                    <h2>Film: <span>{{ $film->title }}</span></h2>
                    <p><strong>Gatunek:</strong> {{ ucfirst($film->category) }}</p>
                    <p><strong>Czas trwania:</strong> {{ intdiv($film->duration, 60) }} godz. {{ $film->duration % 60 }} min</p>

                    @if (auth()->check() && auth()->user()->isAdmin())
                        <div class="actions">
                            <a href="{{ route('films.edit', $film->id) }}" class="btn edit-btn">Edytuj</a>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-btn" onclick="return confirm('Czy na pewno?')">Usuń</button>
                            </form>
                        </div>
                    @endif

                    <!-- Button for Rezerwuj -->
                    <form action="{{ route('films.show', $film->id) }}" method="GET" style="margin-top: 10px;">
                        <button type="submit" class="btn reserve-btn">Rezerwuj</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Brak filmów do wyświetlenia.</p>
        @endforelse
    </section>

    <!-- JavaScript for Filtering -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const genreFilter = document.getElementById("genre");
            const movies = document.querySelectorAll(".movie");

            // Get unique categories from the movie list
            const categories = new Set(); // Use a Set to ensure uniqueness
            movies.forEach(movie => {
                const category = movie.getAttribute("data-category");
                if (category) {
                    categories.add(category);
                }
            });

            // Populate the genre filter dropdown
            genreFilter.innerHTML = ""; // Clear existing options
            genreFilter.insertAdjacentHTML("beforeend", '<option value="all">Wszystkie</option>');
            categories.forEach(category => {
                genreFilter.insertAdjacentHTML("beforeend", `<option value="${category}">${capitalize(category)}</option>`);
            });

            // Add event listener for filtering movies
            genreFilter.addEventListener("change", function () {
                const selectedGenre = genreFilter.value;

                movies.forEach(movie => {
                    const movieCategory = movie.getAttribute("data-category");
                    if (selectedGenre === "all" || movieCategory === selectedGenre) {
                        movie.style.display = "block"; // Show the movie
                    } else {
                        movie.style.display = "none"; // Hide the movie
                    }
                });
            });

            // Helper function to capitalize the first letter
            function capitalize(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }
        });
    </script>
@endsection
