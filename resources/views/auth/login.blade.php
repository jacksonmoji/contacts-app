@extends('layouts.app')

@section('content')

    <section class="resume-section p-5 p-lg-5 d-flex align-items-center">
        <div class="w-100">
            <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-8">
                <div class="resume-content">
                <h3 class="mb-5">{{ __('Login') }}
                    <span class="text-primary">to get stated</span>
                </h3>                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="email" class="text-primary">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <hr class="m-2">
                    <label for="password" class="text-primary">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <hr class="m-2">   
                    <input class="input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>           
                    <hr class="m-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>    
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <hr class="m-2">
                </form>
            </div>
        </div>   
    </section>

@endsection
