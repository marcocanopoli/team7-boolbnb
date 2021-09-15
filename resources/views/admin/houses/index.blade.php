@extends('layouts.app')
@section('content') 

    <div class="container">

        
        @if (session('deleted'))
            <div class="alert alert-success my-alert">
                La struttura <strong>'{{ session('deleted') }}'</strong> è stata eliminata con successo!
            </div>
        @elseif (session('sponsored'))
            <div class="alert alert-success my-alert">
                La struttura <strong>'{{ session('sponsored') }}'</strong> è stata sponsorizzata per <strong>{{ intval(session('promotion')) * 24 }} ore</strong>!
            </div>
        @endif

        <div class="d-flex my-4">
            <h1>Strutture</h1> 
            <a class="bnb-a bnb-btn-r5 bnb-btn-white align-self-center mx-4" href="{{route('admin.houses.create')}}">AGGIUNGI</a>
        </div>
        <div>
            @foreach ($houses as $house)
            <div class="house-container row">
                <div class="col-12 col-md-9">
                    <a href="{{route('admin.houses.show', $house->slug)}}" class="bnb-a">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="img-container shadow @if($activeSponsors[$house->id]) triangle @endif">
                                    <img src="{{ asset('storage/' . $house->photos[0]->path) }}" alt="{{ 'Foto' . $house->photos[0]->id }}">

                                    @if($activeSponsors[$house->id])
                                        <div class="index-sponsor-box">
                                            <i class="fas fa-gem index-sponsor-icon"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="details-container col-12 col-md-8">
                                <p>{{$house->houseType['name']}} a {{$house->city}}</p>
                                <h4>{{$house->title}}</h4>
                                <p>
                                    {{$house->guests}}
                                    @if ($house->guests < 2) ospite @else ospiti @endif
                                    &middot;
                                    {{$house->rooms}}
                                    @if ($house->rooms < 2) camera @else camere @endif da letto
                                    &middot;
                                    {{$house->beds}}
                                    @if ($house->beds < 2) letto @else letti @endif
                                    &middot;
                                    {{$house->bathrooms}}
                                    @if ($house->bathrooms < 2) bagno @else bagni @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-3 align-self-center">
                    <div class="d-flex justify-content-around">
                        <a class="bnb-btn-index" href="{{route('admin.promotions', $house->id)}}">
                            <i class="fas fa-gem"></i>
                        </a>
                        <a class="bnb-btn-index" href="{{route('admin.messages.index')}}">
                            <i class="far fa-paper-plane"></i>
                        </a>
                        <a class="bnb-btn-index" href="{{route('admin.houses.edit', $house->slug)}}">
                            <i class="fas fa-pen"></i>
                        </a>
                        <div class="bnb-btn-delete">
                            <form action="{{route('admin.houses.destroy', $house->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <label for="delete-{{$house->id}}"><i class="fas fa-times"></i></label>
                                <button type="submit" id="delete-{{$house->id}}" 
                                    onclick="return confirm('Vuoi davvero eliminare questa struttura? (L\'operazione non può essere annullata)')">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection