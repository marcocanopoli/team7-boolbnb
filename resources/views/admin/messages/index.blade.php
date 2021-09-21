@extends('layouts.app')
{{-- @dump($houses)  /case logged user ok --}}
{{-- @dump($messages)  --}}

@section('title', 'All Messages')

@section('content')
    <div class="container msg-box ">

        @if (session('messagedel'))
            <div class="alert alert-danger my-alert">
                il messaggio di <strong>'{{ session('messagedel') }}'</strong> è stata eliminato con successo!
            </div>
        @endif
        
        
        <div class="d-flex align-items-center my-3 title-container">
            <i class="far fa-paper-plane mr-3"></i>
            <h2 class="h2">Messaggi ricevuti</h2>
        </div>
        
        
            @foreach ($messages as $houseMessages)
                @if (count($houseMessages) == 0)
                    {{-- accrocco puccio per messaggio 'non ci sono messaggi 'funxiona ma è brutto :D --}}
                    @if ($loop->first)
                        Non ci sono messaggi
                    @endif
                @elseif( count($houseMessages) > 0 )
                    {{-- titolo struttura --}}
                    <div class="d-flex flex-column  my-5">
                        <h3 class=""> Messaggi per la struttura: <strong>{{ $houseMessages[0]->house->title }}</strong></h3>
                        <span class="bnb-btn bnb-btn-brand-2 align-self-start"><small>{{$houseMessages[0]->house->city}}</small></span>
                    </div>
                    {{-- /titolo strutture --}}
                    
                    
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ( $houseMessages as $index => $msg)
                            <div class="col-lg-6 ">
                                <div class="card-msg mb-4 position-relative shadow">
                                    <small class="d-block mb-2"><strong> Ricevuto il: </strong>{{$msg->created_at}}</small>
                                    <h5 class="h5"><strong>Nome: </strong>{{ $msg->guest_name }}</h5>
                                    <h5 class="h5"><strong>E-mail: </strong>{{ $msg->guest_email }}</h5>
                                    <p>{{ $msg->content }}</p>
                                    
                                    {{-- form-absolute delete button --}}
                                    <div class="form-absolute">
                                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class=" bnb-btn-brand-2 del-msg-radius" type="submit" id="delete" value="ELIMINA">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>    
                                    </div> {{-- form-absolute delete button --}}

                                    <div class="btn-row">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2 padd-btn padd-btn-rgt">
                                            <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp" href="mailto:{{$msg->guest_email}}">
                                                <i class="fas fa-reply"></i>
                                                RISPONDI
                                            </a>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2 padd-btn padd-btn-rgt">
                                            <a href="{{ route('admin.messages.show', $msg->id) }}" type="submit" class="bnb-a bnb-btn bnb-btn-brand bnb-btn-resp">
                                                <i class="fas fa-check"></i>
                                                VISUALIZZA
                                            </a> 
                                        </div>
                                    </div> 

                                </div>
                            </div>
                        @endforeach
                        @if ($houseMessages->lastPage() > 1) 
                            <div class="my-pagination m-auto">
                                <!-- a Tag for previous page -->
                                <span class="{{ ($houseMessages->currentPage() == 1) ? 'disabled' : '' }}">
                                    <a href="{{$houseMessages->previousPageUrl()}}">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </span>
                                @for ($i=1; $i <= $houseMessages->lastPage(); $i++)
                                    <span class="{{ ($houseMessages->currentPage() == $i) ? 'active' : '' }}">
                                        <a href="{{ $houseMessages->url($i) }}">{{ $i }}</a>
                                    </span>
                                @endfor
                                <!-- a Tag for next page -->
                                <span class="{{ ($houseMessages->currentPage() == $houseMessages->lastPage()) ? 'disabled' : '' }}">
                                    <a href="{{$houseMessages->nextPageUrl()}}">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>    
                                </span>
                            </div>
                        @endif
                    </div> {{-- /container msg card --}}
                @endif
                
            @endforeach


    </div> {{-- /container --}}
@endsection