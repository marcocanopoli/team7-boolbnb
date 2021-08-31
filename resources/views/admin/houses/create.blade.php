@extends('layouts.app')

@section('content')
<div class="container create-form">
    <form action="{{ route('admin.houses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Nome della struttura</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Inserisci il nome della struttura" name="title" value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="6" name="description" placeholder="Descrivi la tua struttura">{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- <div class="form-group">
            <label for="cover">Immagine di copertina</label>
            <input type="file" name="cover" class="form-control-file @error('cover') is-invalid @enderror" id="cover">
            @error('cover')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div> --}}
        <div class="form-group">
            <label for="house_types">Tipo di struttura </label>
            <select class="form-control @error('house_types') is-invalid @enderror" name="house_types" id="house_types">
                <option value="">-- Seleziona il tipo di struttura--</option>
                @foreach ($houseTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ ($type->id == old('house_types')) ? 'selected' : '' }}
                        >{{ $type->name }}</option>
                @endforeach
            </select>
            @error('house_types')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="d-flex">
            <div class="form-group mr-2">
                <label for="rooms">Numero camere</label>
                <input type="number" name="rooms" value="{{ old('rooms') }}" class="form-control @error('rooms') is-invalid @enderror" id="rooms" placeholder="Camere disponibili">
                @error('rooms')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mx-2">
                <label for="beds">Numero letti</label>
                <input type="number" name="beds" value="{{ old('beds') }}" class="form-control @error('beds') is-invalid @enderror" id="beds" placeholder="Letti disponibili">
                @error('beds')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mx-2">
                <label for="bathrooms">Numero bagni</label>
                <input type="number" name="bathrooms" value="{{ old('bathrooms') }}" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" placeholder="Bagni disponibili">
                @error('bathrooms')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mx-2">
                <label for="square_meters">Mq</label>
                <input type="number" name="square_meters" value="{{ old('square_meters') }}" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                placeholder="Inserisci i Mq">
                @error('square_meters')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="mr-2">
                <label for="address">Indirizzo</label>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" id="address"
                placeholder="Indirizzo della struttura">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mx-2">
                <label for="zip_code">CAP</label>
                <input type="text" name="zip_code" value="{{ old('zip_code') }}" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code"
                placeholder="Inserisci il CAP">
                @error('zip_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mx-2">
                <label for="city">Città</label>
                <input type="text" name="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" id="city"
                placeholder="Inserisci la città">
                @error('city')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <h6>Servizi disponibili</h6>
        <div class="form-group d-flex flex-column flex-wrap mb-5" style="height: 250px;">
            @foreach ($services as $service)
                <div class="form-check ">
                    <input class="form-check-input" type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}" name="services[]" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                    >
                    <label class="form-check-label text-capitalize not-strong" for="service-{{ $service->id }}">{{ $service->name }}</label>
                </div>     
            @endforeach 
            @error('services')
                <div>
                    <small class="text-danger">{{ $message }}</small> 
                </div>
            @enderror   
        </div>
        <div class="form-group">
            <h6>Disponibilità</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('visible') is-invalid @enderror" type="radio" value="{{old('visible')}}" name="visible">
                    <label class="form-check-label mr-2 not-strong" for="visible">Disponibile</label>
                    <input class="form-check-input ml-2 @error('visible') is-invalid @enderror" type="radio" value="{{old('visible')}}" name="visible">
                    <label class="form-check-label not-strong" for="visible">Attualmente non disponibile</label>
                </div> 
            @error('visible')
                <div>
                    <small class="text-danger">{{ $message }}</small> 
                </div>
            @enderror   
        </div>
        <div class="form-group w-25 mb-5">
            <label for="price">Prezzo per notte</label>
            <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="1" class="form-control @error('price') is-invalid @enderror" id="price"
            placeholder="Inserisci il prezzo per notte">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crea</button>
        <a class="btn btn-warning ml-2" href="{{ route('admin.houses.index') }}">Annulla</a>
    </form>
</div>
@endsection