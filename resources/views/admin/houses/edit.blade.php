@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/upload_preview.css') }}">
@endsection

@section('content')

<div class="container create-form">
    
    <div class="d-flex my-4">
        <h1>Modifica: <span class="text-info">{{$house->title}}</span></h1>
    </div>
    
    <form action="{{ route('admin.houses.update', $house->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- Titolo --}}
        <div class="form-group">
            <label for="title">Nome della struttura</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Inserisci il nome della struttura" name="title" value="{{ old('title', $house->title) }}">
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- /Titolo --}}

        {{-- Descrizione --}}
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="6" name="description" placeholder="Descrivi la tua struttura">{{ old('description', $house->description) }}</textarea>
            @error('description')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- /Descrizione --}}

        {{-- Tipologia --}}
        <div class="form-group">
            <label for="house_type_id">Tipo di struttura </label>
            <select class="form-control @error('house_type_id') is-invalid @enderror" name="house_type_id" id="house_type_id">
                <option value="">-- Seleziona il tipo di struttura--</option>
                @foreach ($houseTypes as $type)
                <option value="{{ $type->id }}"
                    {{ ($type->id == old('house_type_id', $house->house_type_id )) ? 'selected' : '' }}
                    >{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('house_type_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        {{-- /Tipologia --}}

        <div class="row d-flex">

            {{-- Camere --}}
            <div class="form-group col-12 col-md-6">
                <label for="rooms">Numero camere</label>
                <input type="number" name="rooms" value="{{ old('rooms', $house->rooms) }}" class="form-control @error('rooms') is-invalid @enderror" id="rooms" placeholder="Camere disponibili">
                @error('rooms')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Camere --}}

            {{-- Ospiti --}}
            <div class="form-group col-12 col-md-6">
                <label for="guests">Numero ospiti</label>
                <input type="number" name="guests" value="{{ old('guests', $house->guests) }}" class="form-control @error('guests') is-invalid @enderror" id="guests" placeholder="Numero ospiti">
                @error('guests')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Ospiti --}}

            {{-- Letti --}}
            <div class="form-group col-12 col-md-6">
                <label for="beds">Numero letti</label>
                <input type="number" name="beds" value="{{ old('beds', $house->beds) }}" class="form-control @error('beds') is-invalid @enderror" id="beds" placeholder="Letti disponibili">
                @error('beds')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Letti --}}
            
            {{-- Bagni --}}
            <div class="form-group col-12 col-md-6">
                <label for="bathrooms">Numero bagni</label>
                <input type="number" name="bathrooms" value="{{ old('bathrooms', $house->bathrooms) }}" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" placeholder="Bagni disponibili">
                @error('bathrooms')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Bagni --}}

            {{-- MQ --}}
            <div class="form-group col-12 col-md-6">
                <label for="square_meters">Mq</label>
                <input type="number" name="square_meters" value="{{ old('square_meters', $house->square_meters) }}" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                placeholder="Inserisci i Mq">
                @error('square_meters')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /MQ --}}            
        </div>
        
        <div class="form-group row d-flex">

            {{-- Indirizzo --}}
            <div class="col-12 col-md-4 mb-2">
                <label for="address">Indirizzo</label>
                <input type="text" name="address" value="{{ old('address', $house->address) }}" class="form-control @error('address') is-invalid @enderror" id="address"
                placeholder="Indirizzo della struttura">
                @error('address')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /Indirizzo --}}

            {{-- CAP --}}
            <div class="col-12 col-md-4 mb-2">
                <label for="zip_code">CAP</label>
                <input type="text" name="zip_code" value="{{ old('zip_code', $house->zip_code) }}" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code"
                placeholder="Inserisci il CAP">
                @error('zip_code')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /CAP --}}

            {{-- Citta' --}}
            <div class="col-12 col-md-4 mb-2">
                <label for="city">Citta'</label>
                <input type="text" name="city" value="{{ old('city', $house->city) }}" class="form-control @error('city') is-invalid @enderror" id="city"
                placeholder="Inserisci la città">
                @error('city')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- Citta' --}}            
        </div>

        {{-- Servizi --}}
        <h6>Servizi disponibili</h6>
        <div class="edit-services form-group">
            @foreach ($services as $service)
            <div class="form-check ">
                <input class="form-check-input" type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}" name="services[]"
                @if (count($house->services->where('id', $service->id)))
                    checked
                @endif
                >
                <label class="form-check-label not-strong" for="service-{{ $service->id }}">{{ $service->name }}</label>
            </div>     
            @endforeach 
            @error('services')
            <div>
                <small class="text-danger">{{ $message }}</small> 
            </div>
            @enderror   
        </div>
        {{-- /Servizi --}}
        
        {{-- photo gallery --}}
        <label class="form-label">Foto della struttura: </label>
        <div class="row mb-5">
            @foreach ($house->photos as $photo)
            <div class="edit-photos col-12 col-sm-5 col-md-3">
                <img src="{{ asset('storage/' . $photo->path)}}" alt="House-img-{{ $photo->id }}" class="mb-2 me-3 d-block">
                @if (count($house->photos) > 1 )
                <div class="form-check form-check-inline d-flex"> 
                    <input class="form-check-input me-2" type="checkbox" id="delete-img-{{ $photo->id }}" name="delete-imgs[]" value="{{ $photo->id }}">
                    <label class="form-check-label" for="delete-img-{{ $photo->id }}">Delete</label>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        {{-- /photo gallery --}}

        {{-- Foto --}}
        <div class="form-group mb-4">
            <label id="upload-label" for="photos">Carica foto (max 15)
                <input type="file" name="photos[]" id="photos" 
                        class="form-control-file @error('photos') is-invalid @enderror" multiple>
                <div id="preview-photos"></div>
            </label>

            <div class="text-right">
                <button class="bnb-btn bnb-btn-brand mt-4" id="reset-upload">RESET</button>
            </div>

            @foreach ($errors->get('photos.*') as $index => $error)
                @foreach($error as $message)
                    <small class="text-danger">{{ $message }}</small><br>
                @endforeach
            @endforeach

            @error('photos')
            <div>
                <small class="text-danger">{{ $message }}</small> 
            </div>
            @enderror
        </div>
        {{-- /Foto --}}

        {{-- Disponibilita' --}}
        <div class="form-group">
            <h6>Disponibilita'</h6>
            <div class="edit-visible pl-3">
                <div class="mr-5">
                    <input class="form-check-input @error('visible') is-invalid @enderror" type="radio" value="1" checked name="visible">
                    <label class="form-check-label mr-2 not-strong" for="visible">Disponibile</label>
                </div>
                <div>
                    <input class="form-check-input @error('visible') is-invalid @enderror" type="radio" value="2" @if(old('visible', 0) == 2) checked @endif name="visible">
                    <label class="form-check-label not-strong" for="visible">Attualmente non disponibile</label>
                </div>
            </div> 
            @error('visible')
            <div>
                <small class="text-danger">{{ $message }}</small> 
            </div>
            @enderror   
        </div>
        {{-- /Disponibilita' --}}

        {{-- Prezzo --}}
        <div class="row">
            <div class="form-group mb-5 col-md-4">
                <label for="price">Prezzo per notte</label>
                <input type="number" name="price" value="{{ old('price', $house->price) }}" step="0.01" min="1" class="form-control @error('price') is-invalid @enderror" id="price"
                placeholder="Inserisci il prezzo per notte">
                @error('price')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- /Prezzo --}}

        <div class="row btn-row">
            <div class="col-12 col-sm-6 col-md-2 my-2">
                <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp" href="{{ route('admin.houses.index') }}">ANNULLA</a>
            </div>
            <div class="col-12 col-sm-6 col-md-2 my-2">
                <button type="submit" class="bnb-a bnb-btn bnb-btn-brand bnb-btn-resp">AGGIORNA</button>
            </div>
        </div> 
    </form>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/upload_preview.js') }}"></script>
@endsection