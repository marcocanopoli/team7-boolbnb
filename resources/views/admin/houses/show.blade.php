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

    <div class="d-flex">
        <h1>{{$house->title}}</h1>
        <span class="bnb-btn bnb-btn-brand-2 align-self-center mx-4">{{ $houseTypes[$house->house_type_id]['name'] }}</span>
    </div>
    <div class="d-flex mt-4">
        <div class="show-info">
            <strong>Numero ospiti: <span>{{$house->guests}}</span></strong>
            <strong>Numero camere: <span>{{$house->rooms}}</span></strong>
            <strong>Numero letti: <span>{{$house->beds}}</span></strong>
            <strong>Numero bagni: <span>{{$house->bathrooms}}</span></strong>
            <strong>Mq: <span>{{$house->square_meters}}</span></strong>
            <strong class="mt-2">Indirizzo: <span>{{$house->address}}, {{$house->zip_code}}, {{$house->city}}</span></strong>
            <small>LA: {{$house->latitude}}</small>
            <small>LO: {{$house->longitude}}</small>
            <strong class="my-2">Descrizione:</strong>
            <p>{{$house->description}}</p>
            <strong>
                @if ($house->visible) 
                    Disponibile
                @else
                    Attualmente non disponibile
                @endif
            </strong>
            <strong>Prezzo: <span>{{$house->price}} &euro;</span></strong>
        </div>

        <div class="show-details pl-3 ml-4">
            <div class="show-photos d-flex flex-wrap">
                @foreach ($house->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ 'Foto' . $photo->id }}">
                @endforeach
            </div>
            <div class="mt-5">
                <strong>Servizi inclusi:</strong>
                <ul class="mt-3 list-unstyled d-flex flex-column flex-wrap">
                @foreach ($house->services as $service)
                    <li>{{$service['name']}}</li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="control my-4">
        <a class="bnb-btn bnb-btn-white my-4" href="{{ route('admin.houses.index') }}">ELENCO STRUTTURE</a>
        <a class="bnb-btn bnb-btn-brand ml-2" href="{{route('admin.houses.edit', $house)}}">MODIFICA</a>
    </div>
</div>

@endsection