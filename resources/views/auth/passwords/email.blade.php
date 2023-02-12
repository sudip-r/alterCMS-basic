@extends('cms.login')

@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="__header_box">
    <div class="__login_box_header text-center">
      <a href="javascript:void(0);" class="h1"><b>Alter</b>CMS</a>
    </div>
      <p class="login-box-msg">{{ __('Reset your password') }}</p>
    <hr>
  </div>
  <div class="__login_box">
      <div class="__login_box_body">
    
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
             
                <div class="row">
                  <!-- /.col -->
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
                  </div>
                  <!-- /.col -->
                </div>
        </form>
<br>
      <p class="mb-1">
        <a href="{{route('login')}}">{{ __('Back to login') }}</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  <div class="__footer_box">
    <hr>
    <p class="__credits">Photo Credit: <a href="https://unsplash.com/@lycansu" target="_blank">unsplash.com/@lycansu</a></p>
    <p class="__credits">Powered by: <a href="https://alterbasestudios.com/" target="_blank">Alterbase Studios</a></p>
  </div>
</div>
<!-- /.login-box -->
@endsection
