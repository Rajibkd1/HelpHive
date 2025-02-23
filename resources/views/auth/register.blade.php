@extends('auth.auth')

@section('reg-content')

<div class="card-back">
    <div class="center-wrap">
        <h4 class="heading">Sign Up</h4>

        <div class="form-group">
            <input type="text" class="form-style" placeholder="Your Name" autocomplete="off">
            <i class="input-icon material-icons">perm_identity</i>
        </div>

        <div class="form-group">
            <input type="email" class="form-style" placeholder="Your Email" autocomplete="off">
            <i class="input-icon material-icons">alternate_email</i>
        </div>

        <div class="form-group">
            <input type="password" class="form-style" placeholder="Your Password" autocomplete="off">
            <i class="input-icon material-icons">lock</i>
        </div>

        <a href="#" class="btn">Submit</a>

        {{-- Add message for users who already have an account --}}
        <p class="text-center">
            Already have an account? 
            <a href="{{ route('login') }}" class="link">Log in</a>
        </p>

    </div>
</div>

@endsection
