@extends('layouts.loginlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div style="background-color: rgba(225, 225, 225, 0.5); backdrop-filter: blur(10px);" class="card">
                <div class="card-header bg-black text-white">{{ __('Login User') }}</div>
                <div class="card-body text-black">



              
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Display error message -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
        
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            
                        </div>

                    

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-danger">{{ __('Continue') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
