@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6">
                                <center><h4 class="card-title" style="margin-top: 50px; margin-bottom: 20px">{{ __('Logowanie') }}</h4></center>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <label class="form-label" for="email">{{ __('Email') }}</label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <label class="form-label" for="password">{{ __('Hasło') }}</label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>



                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark bg-dark bg-gradient">{{ __('Zaloguj') }}</button>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <div class="text-center mt-3">
                                            <a class="small text-muted" href="{{ route('password.request') }}">{{ __('Zapomniałeś hasła?') }}</a>
                                        </div>
                                    @endif



                                </form>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>


@endsection
