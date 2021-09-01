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
    <div class="d-flex mt-4">
        <div class="show-info">
            <strong>Numero camere: <span>{{$house->rooms}}</span></strong>
            <strong>Numero letti: <span>{{$house->beds}}</span></strong>
            <strong>Numero bagni: <span>{{$house->bathrooms}}</span></strong>
            <strong>Mq: <span>{{$house->square_meters}}</span></strong>
            <strong class="mt-2">Indirizzo: <span>{{$house->address}}, {{$house->zip_code}}, {{$house->city}}</span></strong>
            <small>LA: {{$house->latitude}}</small>
            <small>LO: {{$house->longitude}}</small>
            <strong class="my-2">Descrizione:</strong>
            <p>{{$house->description}}</p>
            <strong>Numero ospiti: <span>{{$house->guests}}</span></strong>
            <strong>
                @if ($house->visible) 
                    Disponibile
                @else
                    Attualmente non disponibile
                @endif
            </strong>
            <strong>Prezzo: <span>{{$house->price}} &euro;</span></strong>
        </div>

        <div class="show-photos d-flex flex-wrap">
            @foreach ($house->photos as $photo)
                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ 'Foto' . $photo->id }}">
            @endforeach
        </div>

    </div>
    <a class="btn btn-primary my-4" href="{{ route('admin.houses.index') }}">ELENCO STRUTTURE</a>
    <a class="btn btn-warning ml-2" href="{{route('admin.houses.edit', $house)}}">MODIFICA</a>
</div>

@endsection