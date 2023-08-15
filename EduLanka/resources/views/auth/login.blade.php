@extends('layouts.loginlayout')

@section('content')
<div class="container">
    <div class="login-image">
        <img src="{{ asset('assets/images/s4.jpg') }}" alt="image" class="loginss">
    </div>
    <div class="card-container">
        <div class="card">
            <center><img src="{{ asset('assets/images/Logo.jpg') }}" alt="logo" class="logo"></center>
            <center><h3><b>Welcome Back!</b></h3></center>
            <!-- <div class="card-header bg-black text-white">{{ __('Login User') }}</div> -->
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
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                            <span class="input-group-text toggle-password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>




                
                    <br>

                    <!-- Login Button -->
                    <button type="submit" class="btn-login">{{ __('CONTINUE') }}</button>

                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection
