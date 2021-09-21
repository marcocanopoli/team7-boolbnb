@extends('layouts.app')

@section('title', 'Promotion')

@section('content')
    <div class="container">
        <div class="bnb-cards-container">
            @foreach ($promotions as $promotion)    
            <div class="bnb-card shadow">
                <i class="fas fa-gem icon {{strtolower($promotion->name)}}"></i>
                <h4>{{$promotion->name}}</h4>
                <p>Sponsorizza la tua struttura per: <br>
                   <strong>{{$promotion->duration * 24}} ore</strong>
                </p>
                <h5 class="mb-4">{{$promotion->price}} &euro;</h5>

                <a href="{{route('admin.payment', [$house->id, strtolower($promotion->name)])}}" class="bnb-btn bnb-btn-brand bnb-btn-resp">Acquista</a>
            </div>
        @endforeach
        </div>
    </div>
@endsection