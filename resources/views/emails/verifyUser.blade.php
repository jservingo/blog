<!DOCTYPE html>
<html>
  <head>
    <title>Kodelia</title>
  </head>
  <body>
    <h1>Kodelia</h1>
    <h2>Registro de usuario {{ $name }}</h2> 
    <p>Hemos recibido su solicitud de registro en nuestra plataforma. 
       Por favor, recuerde verificar su identidad para iniciar.
       Puede verificar su correo electrónico, a continuación</p>
    <p>Your registered email is {{ $email }}, Please click on the below link to verify your email account</p>
    <a href="{{url('user/verify', $token)}}">Verify Email</a>
    <p>Si esta solicitud se ha enviado sin su consentimiento, por favor descártela</p>
  </body>
</html>