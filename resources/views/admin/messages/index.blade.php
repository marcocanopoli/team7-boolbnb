@extends('layouts.app')
{{-- @dump($houses)  /case logged user ok
@dump($messages) --}}


@section('content')
    <div class="container msg-box p-0">

        @if (session('messagedel'))
            <div class="row ">
                <div class="alert alert-danger my-alert">
                    il messaggio di <strong>'{{ session('messagedel') }}'</strong> è stata eliminato con successo!
                </div>
            </div>
        @endif
        
        <div class="row">
            <div class="d-flex align-items-center my-3 title-container">
                <i class="far fa-paper-plane mr-3"></i>
                <h2 class="h2">Messaggi ricevuti</h2>
            </div>
        </div>
        
            @foreach ($messages as $houseMessages)
                @if( count($houseMessages) > 0 )
                    <div class="row">
                        <h4 class="h4 my-5"> Messaggi per la struttura: <strong>{{ $houseMessages[0]->house->title }}</strong></h4>
                    </div>

        
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ( $houseMessages as $index => $msg)
                            <div class="col-md-6 card-msg">
                                <span>Messaggio {{ $index + 1 }} </span>
                                <h5 class="h5"><strong>Nome ospite: </strong>{{ $msg->guest_name }}</h5>
                                <h5 class="h5"><strong>E-mail ospite: </strong>{{ $msg->guest_email }}</h5>
                                <h6 class="h6">Contenuto Messaggio: </h6>
                                <p>{{ $msg->content }}</p>
                            
                                <div>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bnb-btn bnb-btn-brand-2 " type="submit" id="delete" value="ELIMINA">ELIMINA</button>
                                    </form>    
                                </div>
                            </div>
                        @endforeach

                        
                    </div>
                @endif
            @endforeach
    </div> {{-- /container --}}
@endsection