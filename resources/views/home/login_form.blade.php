{{-- home.login_form --}} 

<div id="formulario">
  <h2>{{ __('messages.log-in') }}</h2>

  <form role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
      <input type="email" 
              class="form-control" 
              placeholder="{{ __('messages.email') }}" 
              name="email" 
              value="{{ old('email') }}" 
              required autofocus>
      @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
      <input type="password" 
              class="form-control" 
              placeholder="{{ __('messages.password') }}" 
              name="password" 
              required>
      @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
            <input type="checkbox" name="remember"> {{ __('messages.remember-me') }}
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4" style="height:30px;padding-left:100px;">
        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('messages.enter') }}</button>
      </div>
      <!-- /.col -->
    </div>
    {{-- <a href="{{ url('/password/reset') }}">Restablecer contraseña</a><br> --}}
  </form>
</div>

<div style="margin: 0 auto; width:380px;">
  <span>{{ __('messages.please-register') }} 
    <a class="btn_register button green" href="#">
      {{ __('messages.register-now') }}
    </a>
  </span> 
</div>

<div style="margin: 0 auto; width:160px;">
  <span>
    {{ __('messages.register-free') }}
  </span>
</div>

{{-- 
<div class="social-auth-links text-center;">
  <p>- OR -</p>
    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
      Facebook</a>
    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
      Google+</a>
</div>
--}}
<!-- /.social-auth-links -->


{{-- <a href="register.html" class="text-center">Register a new membership</a> --}}