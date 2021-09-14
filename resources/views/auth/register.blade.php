@extends('layouts.app')
@section('content')
<div class="container">

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="user-form">
                <div class="header text-center">Registrati o accedi</div>
                <div class="bnb-form d-flex flex-column align-items-center">
                    <h5>Ti diamo il benvenuto su Boolbnb</h5>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="input-form mt-2">
                            <div class="label w-100">
                                <label for="first_name">{{ __('Nome') }}</label>
                                <input id="first_name" type="text" class="w-100 first @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" maxlength="50">
                                
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="label w-100">
                                <label for="last_name">{{ __('Cognome') }}</label>
                                <input id="last_name" type="text" class="w-100 first @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" maxlength="50">
                                
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="label w-100">
                                <label for="email" >{{ __('E-Mail') }}</label>
                                <input id="email" type="email" class="w-100 first @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="label w-100">
                                <label for="password" class="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="w-100 first @error('password') is-invalid @enderror" name="password">
                            </div>
                            <div class="label w-100">
                                <label for="password-confirm">{{ __('Conferma Password') }}</label>
                                <input id="password-confirm" type="password" class="w-100 first @error('password') is-invalid @enderror" name="password_confirmation">
                            </div>
                            <div class="label w-100">
                                <label for="birthdate">{{ __('Data di nascita') }}</label>
                                <input id="birthdate" type="date" class="w-100 first @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}">
                                
                                @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="label w-100">
                                <label for="phone">{{ __('Telefono') }}</label>
                                <input id="phone" type="text" class="w-100 first @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" maxlength="20">
                                
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="label w-100">
                                <label for="about">{{ __('Info') }}</label>
                                <textarea id="about" class="w-100 @error('about') is-invalid @enderror" name="about" maxlength="3000">{{ old('about') }}</textarea>
                                
                                @error('about')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-12">
                                <label id="upload-label" for="photos">
                                    <input type="file" name="profile_pic" id="photos" 
                                            class="form-control-file @error('photos') is-invalid @enderror">
                                    <div id="preview-photos" class="single-upload"></div>
                                </label>
                            </div>
                            
                            @error('photos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="col-md-3 offset-md-8 text-right mb-2">
                                <button class="bnb-btn bnb-btn-brand py-1" id="reset-upload">RESET</button>
                            </div>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <button type="submit" class="bnb-a bnb-btn bnb-btn-brand bnb-btn-resp w-100 my-2">
                                {{ __('Registrati') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="footer d-flex flex-column align-items-center">
                    <div class="slice text-center my-2">
                        <span>Hai già un account?</span>
                    </div>
                    <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/upload_preview.js') }}"></script>
@endsection
