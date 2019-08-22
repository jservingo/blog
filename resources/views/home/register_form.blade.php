{{-- home.register_form --}} 

<div id="formulario">
  <h2>Register form</h2>

  <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
      @csrf

      <div class="form-group row">
          <div class="col-md-6">
              <input id="name" 
                type="text" 
                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                name="name" 
                value="{{ old('name') }}" 
                placeholder="Name"
                required autofocus>

              @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <div class="col-md-6">
              <input id="email" 
                type="email" 
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="E-Mail Address"
                required>

              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <div class="col-md-6">
              <input id="password" 
                type="password" 
                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                name="password" 
                placeholder="Password"
                required>

              @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <div class="col-md-6">
              <input id="password-confirm" 
                type="password" 
                class="form-control" 
                name="password_confirmation" 
                placeholder="Confirm Password"
                required>
          </div>
      </div>

      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
              </button>
          </div>
      </div>
  </form>
</div>

<p>if you have registered please login<p> 
