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
                    
                <h4 class="h4 my-5"> Messaggi per la struttura: <strong>{{ $houseMessages[0]->house->title }}</strong></h4>
                    

        
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ( $houseMessages as $index => $msg)
                            <div class="col-lg-6 ">
                                <div class="card-msg mb-4 position-relative shadow">
                                    <span class="index-msg">Messaggio {{ $index + 1 }} </span>
                                    <h5 class="h5"><strong>Nome ospite: </strong>{{ $msg->guest_name }}</h5>
                                    <h5 class="h5"><strong>E-mail ospite: </strong>{{ $msg->guest_email }}</h5>
                                    <h6 class="h6">Contenuto Messaggio: </h6>
                                    <p>{{ $msg->content }}</p>
                                    
                                    {{-- form-absolute delete button --}}
                                    <div class="form-absolute">
                                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bnb-btn bnb-btn-brand-2 del-msg-radius" type="submit" id="delete" value="ELIMINA">
                                                <i class="fas fa-times"></i>
                                                <span class="del-msg-txt"> ELIMINA </span>
                                            </button>
                                        </form>    
                                    </div> {{-- form-absolute delete button --}}

                                    <div class=" btn-row">
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2">
                                            <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp" href="#">
                                                <i class="fas fa-reply"></i>
                                                RISPONDI
                                            </a>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2">
                                            
                                            <button type="submit" class="bnb-a bnb-btn bnb-btn-brand bnb-btn-resp">
                                                <i class="fas fa-check"></i>
                                                CONFERMA
                                            </button>
                                        </div>
                                    </div> 

                                </div>
                            </div>
                        @endforeach
                        <div class="my-pagination m-auto">
                            <!-- a Tag for previous page -->
                            <a href="{{$houseMessages->previousPageUrl()}}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            @for($i=0;$i<=$houseMessages->lastPage();$i++)
                                <!-- a Tag for another page -->
                                <a href="{{$houseMessages->url($i)}}">{{$i}}</a>
                            @endfor
                            <!-- a Tag for next page -->
                            <a href="{{$houseMessages->nextPageUrl()}}">
                                <i class="fas fa-chevron-right"></i>
                            </a>    
                        </div>
                            {{-- <div class=" d-flex justify-content-center m-auto">
                                {{ $houseMessages->links() }}
                            </div> --}}
                        
                    </div>
                @endif
            @endforeach
    </div> {{-- /container --}}
@endsection