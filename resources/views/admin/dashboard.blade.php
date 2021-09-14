@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('loggedIn'))
        <div class="alert alert-success" role="alert">
            {{ session('loggedIn') }}
        </div>
    @elseif (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <h1 class="mt-4">Account</h1>
    <h5 class="d-inline color-brand">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
    <span class="color-gray-2">, {{ Auth::user()->email }}</span>

    <div class="bnb-cards-container mt-5 mb-4 color-gray-2">
        {{-- <a href="#" class="bnb-card shadow">
            <i class="fas fa-id-card"></i>
            <h4>Profilo &rsaquo;</h4>
            <p>Visualizza e modifica i tuoi dati personali</p>
        </a> --}}
        <a href="{{ route('admin.houses.index') }}" class="bnb-card shadow">
            <i class="fas fa-home"></i>
            <h4>Le mie strutture &rsaquo;</h4>
            <p>Visualizza, crea e modifica le tue strutture</p>
        </a>
        <a href="#" class="bnb-card shadow">
            <i class="fas fa-chart-pie"></i>
            <h4>Statistiche &rsaquo;</h4>
            <p>Visualizza statistiche riguardanti le tue strutture</p>
        </a>
        <a href="{{ route('admin.messages') }}" class="bnb-card shadow">
            <i class="fas fa-envelope-open"></i>
            <h4>Messaggi &rsaquo;</h4>
            <p>Visualizza e rispondi ai messaggi e richiete degli utenti</p>
        </a>
    </div>

</div>
@endsection
