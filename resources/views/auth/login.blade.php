@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="user-form">
                <div class="header text-center">Accedi o registrati</div>
                <div class="bnb-form d-flex flex-column align-items-center">

                    <h5>Ti diamo il benvenuto su Boolbnb</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-form mt-2">
                            <div class="label w-100">
                                <label for="email" >{{ __('E-Mail') }}</label>
                                <input id="email" type="email" class="w-100 first @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="label">
                                <label for="password" class="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="w-100 @error('password') is-invalid @enderror" name="password">
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <button type="submit" class="bnb-a bnb-btn bnb-btn-brand bnb-btn-resp w-100 my-2">
                                {{ __('Accedi') }}
                            </button>
    
                            @if (Route::has('password.request'))
                                <a class="bnb-a" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="footer d-flex flex-column align-items-center">
                    <div class="slice text-center my-2">
                        <span>Oppure</span>
                    </div>
                    <a class="bnb-a bnb-btn bnb-btn-white bnb-btn-resp" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
