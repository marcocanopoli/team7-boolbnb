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
            <a href="{{route('admin.houses.show', $house)}}" class="bnb-a">
                <div class="house-container row">
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
            @endforeach
            {{-- <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>Citt&agrave;</th>
                    <th>Prezzo</th>
                    <th>Visibile</th>
                    <th>Tipologia</th>
                    <th colspan="3">Azioni</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($houses as $house)
                    <tr>
                        <td>{{ $house->id }}</td>
                        <td>{{ $house->title }}</td>
                        <td>{{ $house->city }}</td>
                        <td>&euro;{{ $house->price }}</td>
                        <td>{{ $house->visible }}</td>
                        <td>{{ $houseTypes[$house->house_type_id]['name'] }}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('admin.houses.show', $house)}}">MOSTRA</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{route('admin.houses.edit', $house)}}">MODIFICA</a>
                        </td>
                        <td>
                            <form action="{{route('admin.houses.show', $house->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" onclick="return confirm('Do you want delete this post? this action can\'tn be undone')" value="ELIMINA">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>
    </div>
@endsection