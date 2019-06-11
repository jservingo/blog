<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('page-title',config('app.name'))</title>
    <meta name='description' content="@yield('page-description','Esto es Kodelia Ads')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    -->
    <link rel="stylesheet" href="/css/normalize.css">
    <!--<link rel="stylesheet" href="/css/framework.css">-->
    <link rel="stylesheet" href="/css/style.css">
    <!--<link rel="stylesheet" href="/css/responsive.css">-->
    <link rel="stylesheet" href="/css/confirmDialog.css">
    <link rel="stylesheet" href="/css/jquery.growl.css">
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/buttons.css">
    <link rel="stylesheet" href="/css/popr.css">
    <link rel="stylesheet" href="/css/jqsimplemenu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script> 
    @stack('styles')
</head>
<body>
    <!--<div class="preload"></div>-->
    @include('home.header')
    @include('home.menu_standard')
    @yield('content')
    @include('home.footer')
    @stack('scripts')      
</body>
</html>    