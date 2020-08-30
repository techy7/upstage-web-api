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
            Sign In To To Manage Your App
        </h3>
    </div>
    <form class="m-login__formx m-form" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group m-form__group">
            <input class="form-control m-input  @error('email') is-invalid @enderror"   
                type="text" 
                placeholder="Email" 
                name="email" 
                autocomplete="off"
                value="{{ old('email') }}"
            >
            @error('email')
                <span class="text-danger px-3 d-inline-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
        </div>
        <div class="form-group m-form__group">
            <input class="form-control m-input m-login__form-input--last" 
                type="password" 
                placeholder="Password" 
                name="password"
            >
            @error('password')
                <span class="text-danger px-3 d-inline-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
        </div>
        <div class="row m-login__form-sub">
            <div class="col m--align-left m-login__form-left">
                <input type="checkbox" 
                    name="remember" 
                    id="remember" 
                    class="d-none" 
                    checked 
                >
                
                <label class="m-checkbox  m-checkbox--light">
                    <input type="checkbox" 
                        name="remember_me" 
                        id="remember_me" 
                        {{ old('remember') ? 'checked' : '' }}
                    > 
                    Remember me
                    <span></span>
                </label>
            </div>
            <div class="col m--align-right m-login__form-right">
                <a href="{{ route('password.request') }}" id="m_login_forget_password" class="m-link">
                    Forget Password ?
                </a>
            </div>
        </div>
        <div class="m-login__form-action mt-3">
            <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--custom m-btn--air  m-login__btn m-login__btn--info">
                Sign In
            </button>
        </div>
    </form>
</div>
 
  
@endsection
