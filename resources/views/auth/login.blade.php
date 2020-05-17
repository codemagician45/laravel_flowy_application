@extends('layouts.login')
@section("title", "Inloggen")
@section('content')
    <div class="h5 modal-title text-center">
        <h4 class="mt-2">
            <span>Je kunt hier inloggen op je account.</span>
        </h4>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-row">

            @error('email')
        <div class="message-error" >{{ $message }}</div>
            @enderror

            <div class="col-md-12">
                <div class="position-relative form-group"><input id="email" type="email" class="form-control"
                                                                 name="email" placeholder="E-mail"
                                                                 value="{{ old('email') }}" required
                                                                 autocomplete="email" autofocus></div>

            </div>
            <div class="col-md-12">
                <div class="position-relative form-group"><input id="password" type="password" class="form-control"
                                                                 name="password" placeholder="Wachtwoord" required
                                                                 autocomplete="current-password"></div>
            </div>
        </div>

        <button class="btn btn-primary btn-lg btn-login">Inloggen</button>


        <div class="password-forget"><a href="javascript:void(0);" class="text-primary">Wachtwoord vergeten?</a></div>

    </form>
@endsection
