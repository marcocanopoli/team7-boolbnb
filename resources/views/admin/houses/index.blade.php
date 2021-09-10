@extends('layouts.app')
@section('content')    

    <div class="container">

        @if (session('deleted'))
            <div class="alert alert-success my-alert">
                La struttura <strong>'{{ session('deleted') }}'</strong> è stata eliminata con successo!
            </div>
        @endif

        <div class="d-flex my-4">
            <h1>Strutture</h1> 
            <a class="bnb-a bnb-btn-r5 bnb-btn-white align-self-center mx-4" href="{{route('admin.houses.create')}}">AGGIUNGI UNA STRUTTURA</a>
        </div>
        <div>
            @foreach ($houses as $house)
            <div class="house-container row">
                <div class="col-12 col-md-10">
                    <a href="{{route('admin.houses.show', $house)}}" class="bnb-a">
                        <div class="row">
                            <div class="img-container col-12 col-md-4">
                                <img src="{{ asset('storage/' . $house->photos[0]->path) }}" alt="{{ 'Foto' . $house->photos[0]->id }}">
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
                <div class="col-12 col-md-2 align-self-center">
                    <div class="d-flex justify-content-around">
                        <a href="{{route('admin.promotions', $house->id)}}"><i class="fas fa-gem"></i></a>
                        <a class="bnb-btn-edit" href="{{route('admin.houses.edit', $house)}}">
                            <i class="fas fa-pen"></i>
                        </a>
                        <div class="bnb-btn-delete">
                            <form action="{{route('admin.houses.show', $house->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <label for="delete"><i class="fas fa-times"></i></label>
                                <input type="submit" id="delete" onclick="return confirm('Do you want delete this post? this action can\'tn be undone')" value="ELIMINA">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection