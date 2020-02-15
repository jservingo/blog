{{-- home.register_form --}} 

<div id="formulario">
  <h2>{{ __('messages.sign-up') }}</h2>

  <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
      @csrf

      <div class="form-group row">
          <div class="col-md-6">
              <input id="name" 
                type="text" 
                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                name="name" 
                value="{{ old('name') }}" 
                placeholder="{{ __('messages.username') }}"
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
                placeholder="{{ __('messages.email') }}"
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
                placeholder="{{ __('messages.password') }}"
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
                placeholder="{{ __('messages.confirm') }}"
                required>
          </div>
      </div>

      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  {{ __('messages.register') }}
              </button>
          </div>
      </div>
  </form>
</div>

<p>{{ __('messages.please-sign-up') }}<p> 
