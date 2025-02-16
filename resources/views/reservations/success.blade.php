@extends('layouts.app')

@section('content')
<h1>Rezerwacja zakończona sukcesem!</h1>
<p>Twoje bilety zostały zarezerwowane. Prosimy o dokonanie płatności w kasie kina.</p>

<a href="{{ route('films.index') }}" class="btn submit-btn">Powrót do Filmów</a>
@endsection
