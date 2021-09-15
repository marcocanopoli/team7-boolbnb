@extends('layouts.app')
{{-- @dump($houses)  /case logged user ok
@dump($messages) --}}


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
                @if( count($houseMessages) > 0 )
                    
                <h3 class="h3 my-5"> Messaggi per la struttura: <strong>{{ $houseMessages[0]->house->title }}</strong></h3>
                    

        
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ( $houseMessages as $index => $msg)
                            <div class="col-lg-6 ">
                                <div class="card-msg mb-4 position-relative shadow">
                                    <h4 class="h4 my-3">Messaggio {{ $index + 1 }} </h4>
                                    
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
                                        <div class="col-12 my-2 padd-btn padd-btn-left">
                                            <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp" href="mailto:{{$msg->guest_email}}">
                                                <i class="fas fa-reply"></i>
                                                RISPONDI
                                            </a>
                                        </div>
                                        {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2 padd-btn padd-btn-rgt">
                                            <button type="submit" class="bnb-a bnb-btn bnb-btn-brand bnb-btn-resp">
                                                <i class="fas fa-check"></i>
                                                CONFERMA
                                            </button>
                                        </div> --}}
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