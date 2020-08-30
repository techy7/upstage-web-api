@extends('layouts.metronic.classic.auth')

@section('content')

<style>
.login-box {
    padding: 20px;
    background-color: #D6E7EE; 
    border-radius: 10px;
    /*background-image: url({{ asset('metronic/media/img/bg/bg-1.jpg')}});*/
    
}    
</style>

<div class="m-login__signin login-box">
    <div class="m-login__head">
        <h3 class="m-login__title text-dark">
            Reset Password
        </h3>
    </div>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group m-form__group">
            <input id="email" 
                type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="email" 
                autofocus
            >
            @error('email')
                <span class="text-danger px-3 d-inline-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
        </div> 
         
        <div class="m-login__form-action mt-3">
            <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--custom m-btn--air  m-login__btn m-login__btn--info">
                Send Password Reset Link
            </button>
        </div>
    </form>
</div>


@endsection
