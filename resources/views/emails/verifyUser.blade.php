<!DOCTYPE html>
<html>
  <head>
    <title>Kodelia</title>
  </head>
  <body>
    <h1>Kodelia</h1>
    @if (Config::get('app.locale')=='en')
      <h2>User Registration: {{ $name }}</h2> 
      <p>We have received your registration request on our platform. 
         Please remember to verify your identity to start.
         You can check your email, below.</p>
      <p>Your registered email is {{ $email }}, Please click on the below link to verify your email account.
      <a href="{{url('user/verify', $token)}}">Verify email</a></p>
      <p>If this request has been sent without your consent, please discard it.</p>
    @else if (Config::get('app.locale')=='es')
      <h2>Registro de usuario: {{ $name }}</h2> 
      <p>Hemos recibido su solicitud de registro en nuestra plataforma. 
         Por favor, recuerde verificar su identidad para iniciar.
         Puede verificar su correo electrónico, a continuación.</p>
      <p>Su email registrado es {{ $email }}, Haga clic en el siguiente enlace para verificar su cuenta de correo electrónico.
      <a href="{{url('user/verify', $token)}}">Verificar email</a></p>
      <p>Si esta solicitud se ha enviado sin su consentimiento, por favor descártela.</p>
    @endif
  </body>
</html>