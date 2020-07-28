@extends('layouts.app')

@section('title', '- Đăng nhập')



@section('header')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">


<script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '312841173201962',
        cookie     : true,
        xfbml      : true,
        version    : 'v7.0'
      });

      FB.AppEvents.logPageView();

    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
@endsection

@section('content')
<div class="container">
    <div class="row login-card">
        <div class="col-md-8 text-center">
            <div class="login-frame medi">
                <h3 class="h3 py-3">
                    Trắc nghiệm online toán
                </h3>
                <p>các lớp từ 6 đến 12</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="login-frame medi p-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">Tên đăng nhập</label>

                        <div class="col-md-6">
                            <input id="username" type="username"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Lưu đăng nhập
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Đăng nhập
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <blockquote class="my-3 blockquote">hoặc đăng nhập với</blockquote>
        <div class="col-md-8 p-mini">
            <div class="login-frame mini">
                <a href="{{ route('login.3rd','facebook') }}" class="network">
                    <i class="fab fa-facebook-f" style="color: #3b5998;"></i>
                </a>
                <a href="{{ route('login.3rd','google') }}" class="network">
                    <i class="fab fa-google" style="color: #e72626;"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
