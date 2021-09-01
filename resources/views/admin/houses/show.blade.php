@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('created'))
        <div class="alert alert-success my-alert">
            La struttura <strong>'{{ session('created') }}'</strong> è stata creata con successo!
        </div>
    @elseif (session('updated'))
        <div class="alert alert-success my-alert">
            La struttura <strong>'{{ session('updated') }}'</strong> è stata modificata con successo!
        </div>
    @endif

    <h1>{{$house->title}}</h1>
    <div class="d-flex">
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

        <div class="show-photos d-flex flex-wrap align-items-start">
            @foreach ($house->photos as $photo)
                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ 'Foto' . $photo->id }}">
            @endforeach
        </div>

    </div>
    <a class="btn btn-secondary my-4" href="{{ route('admin.houses.index') }}">Elenco case</a>
</div>

@endsection