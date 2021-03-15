@extends('layouts.app')

@section('styles')
    <link href="{{ asset("css/admin/admin-2.css") }}" rel="stylesheet">
    <script src="{{ asset("js/admin/admin-2.js") }}"></script>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-10 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 ">
                    <div class="card-header text-center">
                        <h4 class="h4">{{ __('Create an Account!') }}</h4>
                    </div>
                    <div class="card-body p-0 ">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="p-5">
                                    <form class="user" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" 
                                                id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                                placeholder="Full Name">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                                                id="email" name="email" value="{{ old('email') }}" required autocomplete="name" autofocus
                                                placeholder="Email Address">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    id="password" name="password" required autocomplete="new-password"
                                                    placeholder="Password">
                                    
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password-confirm" name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Repeat Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    {{ __('Register Account') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>

                                    @if (Route::has('password.request'))
                                        <div class="text-center">
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <a class="small" href="{{ route('login') }}">
                                                {{ __('Already have an account? Login!') }}
                                            </a>
                                        </div>
                
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
@endsection







{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
