@extends('layouts.app')
@section('content')

@section('title', 'House')

<div class="container show">

    @if (session('created'))
        <div class="alert alert-success my-alert">
            La struttura <strong>'{{ session('created') }}'</strong> è stata creata con successo!
        </div>
    @elseif (session('updated'))
        <div class="alert alert-success my-alert">
            La struttura <strong>'{{ session('updated') }}'</strong> è stata modificata con successo!
        </div>
    @endif

    <div class="d-flex flex-column align-items-start">
    
    @if($activeSponsor)
    <i class="fas fa-gem show-sponsor-icon"></i>              
    @endif
    
        <h1>{{$house->title}}</h1>
        
        <span class="bnb-btn bnb-btn-brand-2 ">{{ $house->houseType['name'] }}</span>
    </div>

    <div class="show-photos my-4">
        @foreach ($house->photos as $photo)
            <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ 'Foto' . $photo->id }}">
        @endforeach
    </div>

    <div class="row">
        <div class="show-info col-lg-6">
            <strong>Numero ospiti: <span>{{$house->guests}}</span></strong>
            <strong>Numero camere: <span>{{$house->rooms}}</span></strong>
            <strong>Numero letti: <span>{{$house->beds}}</span></strong>
            <strong>Numero bagni: <span>{{$house->bathrooms}}</span></strong>
            <strong>Mq: <span>{{$house->square_meters}}</span></strong>            
            <strong class="my-2">Servizi inclusi:</strong>
            <ul class="list-unstyled flex-column flex-wrap">
            @foreach ($house->services as $service)
                <li>
                    <div class="service-svg mr-2">
                        <img src="{{asset('images/services_icons/'.$service->icon)}}" alt="{{$service->icon}}">
                    </div>
                    {{$service['name']}}
                </li>
            @endforeach
            </ul>
            <strong class="my-2">Descrizione:</strong>
            <p>{{$house->description}}</p>            
        </div>

        <div class="show-details col-lg-6">
            <strong>Indirizzo: <span>{{$house->address}}, {{$house->zip_code}}, {{$house->city}}</span></strong>
            {{-- Mappa --}}
            <div id="map-div" class="pr-3 my-4"></div>            
            {{-- /Mappa --}}
        </div>
    </div>    

    <div>
        <strong>Prezzo: <span>{{$house->price}} &euro;</span></strong>
        <strong class="color-brand my-2">
            @if ($house->visible == 1) 
                Visibile
            @else
                Attualmente non visibile
            @endif
        </strong>
    </div>

    <div class="row btn-row my-2">

        <div class="col-12 col-sm-6 col-md-4 my-2">
            <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp" href="{{ route('admin.houses.index') }}">ELENCO STRUTTURE</a>
        </div>
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <a class="bnb-btn bnb-btn-brand bnb-btn-resp" href="{{route('admin.houses.edit', $house->slug)}}">MODIFICA</a>
        </div>
    </div> 
</div>
@endsection

@section('script')
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
    <script>
        const API_KEY = '9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx';
        const APPLICATION_NAME = 'BoolBnb';
        const APPLICATION_VERSION = '1.0';
        const latitude = {!! json_encode($house->latitude) !!};      
        const longitude = {!! json_encode($house->longitude) !!};      
        const coordinates = {lat: latitude, lon: longitude};

        var map = tt.map({
            key: API_KEY,
            container: 'map-div',
            center: coordinates,
            zoom: 16
        });

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        var marker = new tt.Marker().setLngLat(coordinates).addTo(map);
    </script>
@endsection