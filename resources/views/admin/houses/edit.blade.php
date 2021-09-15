@extends('layouts.app')
@section('content')

<div class="container create-form user-form">
    
    <div class="my-4">
        <h1>Modifica: <span class="color-brand">{{$house->title}}</span></h1>
    </div>
    
    <form action="{{ route('admin.houses.update', $house->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off" class="bnb-form">
        @csrf
        @method('PATCH')

        {{-- Titolo --}}
        <div class="input-form mt-2 w-100">
            <div class="label w-100">
                <label for="title">Nome della struttura</label>
                <input type="text" class="w-100 @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $house->title) }}">
            </div>
        </div>
        {{-- /Titolo --}}

        {{-- Descrizione --}}
        <div class="input-form mt-2 w-100">
            <div class="label w-100">
                <label for="description">Descrizione</label>
                <textarea class="w-100 @error('description') is-invalid @enderror" id="description" rows="6" name="description">{{ old('description', $house->description) }}</textarea>
            </div>
        </div>
        {{-- /Descrizione --}}

        {{-- Tipologia --}}
        <div class="input-form mt-2 w-100">
            <div class="label w-100">
                <label for="house_type_id">Tipo di struttura </label>
                <select class="w-100 @error('house_type_id') is-invalid @enderror" name="house_type_id" id="house_type_id">
                    <option value="">-- Seleziona il tipo di struttura--</option>
                    @foreach ($houseTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ ($type->id == old('house_type_id', $house->house_type_id )) ? 'selected' : '' }}
                        >{{ $type->name }}
                    </option>
                        @endforeach
                </select>
            </div>
        </div>
        {{-- /Tipologia --}}

    
        <div class="d-flex flex-wrap justify-content-between my-4">

            {{-- Camere --}}
            <div class="input-form mt-2 col-12 col-md-5">
                <div class="label w-100">
                    <label for="rooms">Numero camere</label>
                    <input type="number" name="rooms" value="{{ old('rooms', $house->rooms) }}" class="w-100 @error('rooms') is-invalid @enderror" id="rooms">
                </div>
            </div>
            {{-- /Camere --}}

            {{-- Ospiti --}}
            <div class="input-form mt-2 col-12 col-md-5">
                <div class="label w-100">
                    <label for="guests">Numero ospiti</label>
                    <input type="number" name="guests" value="{{ old('guests', $house->guests) }}" class="w-100 @error('guests') is-invalid @enderror" id="guests">
                </div>
            </div>
            {{-- /Ospiti --}}

            {{-- Letti --}}
            <div class="input-form mt-2 col-12 col-md-5">
                <div class="label w-100">
                    <label for="beds">Numero letti</label>
                    <input type="number" name="beds" value="{{ old('beds', $house->beds) }}" class="w-100 @error('beds') is-invalid @enderror" id="beds">
                </div>
            </div>
            {{-- /Letti --}}
            
            {{-- Bagni --}}
            <div class="input-form mt-2 col-12 col-md-5">
                <div class="label w-100">
                    <label for="bathrooms">Numero bagni</label>
                    <input type="number" name="bathrooms" value="{{ old('bathrooms', $house->bathrooms) }}" class="w-100 @error('bathrooms') is-invalid @enderror" id="bathrooms">
                </div>
            </div>
            {{-- /Bagni --}}

            {{-- MQ --}}
            <div class="input-form mt-2 col-12 col-md-5">
                <div class="label w-100">
                    <label for="square_meters">Mq</label>
                    <input type="number" name="square_meters" value="{{ old('square_meters', $house->square_meters) }}" class="w-100 @error('square_meters') is-invalid @enderror" id="square_meters">
                </div>
            </div>
            {{-- /MQ --}}            
        </div>

        <div class="d-flex flex-wrap my-4 justify-content-between">

            {{-- Indirizzo --}}
            <div class="input-form mt-2 col-12 col-md-3">
                <div class="label w-100" id="geo-address">
                    <label for="address">Indirizzo</label>
                    <input type="text" name="address" value="{{ old('address', $house->address) }}" class="w-100 @error('address') is-invalid @enderror" id="address" onkeyup="getLocation()">
                    <ul id="finded" class="d-none"></ul>
                </div>
            </div>
            {{-- /Indirizzo --}}

            {{-- CAP --}}
            <div class="input-form mt-2 col-12 col-md-3">
                <div class="label w-100">
                    <label for="zip_code">CAP</label>
                    <input type="text" name="zip_code" value="{{ old('zip_code', $house->zip_code) }}" class="w-100 @error('zip_code') is-invalid @enderror" id="zip_code">
                </div>
            </div>
            {{-- /CAP --}}

            {{-- Citta' --}}
            <div class="input-form mt-2 col-12 col-md-3">
                <div class="label w-100">
                    <label for="city">Citta'</label>
                    <input type="text" name="city" value="{{ old('city', $house->city) }}" class="w-100 @error('city') is-invalid @enderror" id="city">
                </div>
            </div>
            {{-- Citta' --}}            
        </div>

        {{-- Servizi --}}
        <h6>Servizi disponibili</h6>
        <div class="edit-services form-group">
            @foreach ($services as $service)
            <div class="mb-3">
                <label class="container-checkbox form-check-label not-strong" for="service-{{ $service->id }}">{{ $service->name }}

                <input class="form-check-input vertical-align-center mx-3" type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}" name="services[]"
                @if (count($house->services->where('id', $service->id)))
                    checked
                @endif
                >
                <span class="checkmark"></span>
                </label>
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
                    <label class="form-check-label container-checkbox del-label" for="delete-img-{{ $photo->id }}">
                        <input class="form-check-input" type="checkbox" id="delete-img-{{ $photo->id }}" name="delete-imgs[]" value="{{ $photo->id }}">
                    <span class="delete-txt"> Rimuovi </span>
                        <span class="checkmark del-span"></span>
                    </label>
                </div>
                @endif
            </div>
            @endforeach
        </div>

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

        {{-- Disponibilita'  toggle switch--}}
        <div class="form-group d-flex flex-wrap justify-content-between">
            <h6 class="pt-2">Vuoi rendere disponibile la tua struttura?</h6>

            <div class="edit-visible switch-field ">

                <input id="visible-no" class="form-check-input @error('visible') is-invalid @enderror" type="radio"
                value="2" {{ old('visible', $house->visible) == 2 ? 'checked' : '' }} name="visible">
                <label class="form-check-label not-strong no" for="visible-no">No</label>
                
                <input id="visible-si" class="form-check-input @error('visible') is-invalid @enderror" type="radio"
                value="1" {{ old('visible', $house->visible) == 1 ? 'checked' : '' }} name="visible">
                <label class="form-check-label mr-2 not-strong yes" for="visible-si">Si</label>
            
            </div> 
            @error('visible')
            <div>
                <small class="text-danger">{{ $message }}</small> 
            </div>
            @enderror   
        </div>
        {{-- /Disponibilita'  toggle switch--}}

        {{-- Prezzo --}}
        <div class="d-flex">
            <div class="input-form mb-5 col-md-4">
                <div class="label w-100">
                    <label for="price">Prezzo per notte</label>
                    <input type="number" name="price" value="{{ old('price', $house->price) }}" step="0.01" min="1" class="w-100 @error('price') is-invalid @enderror" id="price">
                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
        const currentAxios = axios.create();
        currentAxios.defaults.headers.common = {};
        currentAxios.defaults.headers.common.accept = 'application/json';

        var cities = []
        var resAddress = ''
        var resCity = ''

        function getLocation() {

                var search = address.value.replace(/\s/g, '%20')
                if (search.length > 2) {
                    currentAxios
                        .get(`https://api.tomtom.com/search/2/geocode/${search}.json?limit=10&countrySet=it&language=it-IT&key=MAy8CruNqMtQAbImXBd9FqGR76Ch0nGA&language=it-IT`)
                        .then(
                            res => {
                                cities = res.data.results;
                                document.getElementById('finded').classList.add('d-block')
                                cities.forEach(
                                    city => {
                                        document.getElementById('finded').innerHTML = `<li id="set-city">${city.address.freeformAddress}, ${city.address.countrySubdivision}</li>`;
                                        resAddress = city.address.freeformAddress
                                        resCity = city.address.countrySecondarySubdivision
                                    }
                                );

                                document.getElementById('set-city').addEventListener('click', setCity)
    
                                function setCity() {
                                document.getElementById('address').value = resAddress
                                document.getElementById('city').value = resCity
                                document.getElementById('finded').classList.remove('d-block')

                                }

                            }
                        )
                } else if (search.length < 2)  {
                    document.getElementById('finded').classList.remove('d-block')
                }
                
            }
    </script>
@endsection