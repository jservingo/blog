<!DOCTYPE html>
<html>
  <head>
    <title>Kodelia</title>
  </head>
  <body>
    <h2>Welcome to the site {{ $name }}</h2>
    <br/>
    Your registered email is {{ $email }} , Please click on the below link to verify your email account
    <br/>
    <a href="{{url('user/verify', {{ $token }}">Verify Email</a>
  </body>
</html>