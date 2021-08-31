@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$house->title}}</h1>
    <div class="show-info">
        <span>Numero camere: {{$house->rooms}}</span>
        <span>Numero letti: {{$house->beds}}</span>
        <span>Numero bagni: {{$house->bathrooms}}</span>
        <span>Mq: {{$house->square_meters}}</span>
        <span class="my-2">Indirizzo: {{$house->address}}, {{$house->zip_code}}, {{$house->city}} </span>
        <small>LA: {{$house->latitude}}</small>
        <small>LO: {{$house->longitude}}</small>
        <span>Descrizione:</span>
        <p class="my-2">{{$house->description}}</p>
        <span>Numero ospiti: {{$house->guests}}</span>
        <span>
            @if ($house->visible) 
                Disponibile
            @else
                Attualmente non disponibile
            @endif
        </span>
        <span>Prezzo: {{$house->price}} &euro;</span>
    </div>
    <a class="btn btn-secondary my-4" href="{{ route('admin.houses.index') }}">Elenco case</a>
</div>

@endsection