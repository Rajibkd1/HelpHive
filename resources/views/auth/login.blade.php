@extends('auth.auth')

@section('log-content')

<div class="card-front">
    <div class="center-wrap">
        <h4 class="heading">Log In</h4>

        <div class="form-group">
            <input type="email" class="form-style" placeholder="Your Email" autocomplete="off">
            <i class="input-icon material-icons">alternate_email</i>
        </div>

        <div class="form-group">
            <input type="password" class="form-style" placeholder="Your Password" autocomplete="off">
            <i class="input-icon material-icons">lock</i>
        </div>

        <a href="#" class="btn">Submit</a>
        <p class="text-center"><a href="#" class="link">Forgot your password?</a></p>

        {{-- Add message for users without an account --}}
        <p class="text-center">
            Don't have an account? 
            <a href="{{ route('register') }}" class="link">Create one</a>
        </p>

    </div>
</div>

@endsection
