{{-- home.login_form --}} 

<p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>

<form role="form" method="POST" action="{{ url('/login') }}">
  {{ csrf_field() }}
  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
    <input type="email" 
            class="form-control" 
            placeholder="Email" 
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
            placeholder="Contraseña" 
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
        <label>
          <input type="checkbox" name="remember"> Recuérdame
        </label>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
    </div>
    <!-- /.col -->
  </div>
</form>

{{-- 
<div class="social-auth-links text-center">
  <p>- OR -</p>
  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
    Facebook</a>
  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
    Google+</a>
</div>
--}}
<!-- /.social-auth-links -->

<a href="{{ url('/password/reset') }}">Restablecer contraseña</a><br>
{{-- <a href="register.html" class="text-center">Register a new membership</a> --}}