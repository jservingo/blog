<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('page-title',config('app.name'))</title>
    <meta name='description' content="@yield('page-description','Kodelia allows users to create and save posts created by other users. Organizing them in multiple catalogs, pages and powerfull aplications to easily share and find the information posted.')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42525026-2"></script>
    <meta name="google-site-verification" content="ChnH9B-j1eYiI0XwyON37KJboMQ_7VW1Ux2-9MneZXk" />
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-42525026-2');
    </script>

    <!--
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    -->
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css?ver=1.2">
    <link rel="stylesheet" href="/css/confirmDialog.css?ver=1.1">
    <link rel="stylesheet" href="/css/jquery.growl.css?ver=1.1">
    <link rel="stylesheet" href="/css/search.css?ver=1.1">
    <link rel="stylesheet" href="/css/buttons.css?ver=1.1">
    <link rel="stylesheet" href="/css/popr.css?ver=1.1">
    <link rel="stylesheet" href="/css/tipr.css?ver=1.1">
    <link rel="stylesheet" href="/css/jqsimplemenu.css?ver=1.1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/jstree-style.min.css" />
    <link rel="stylesheet" href="/css/font-lato.css">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/jstree.min.js"></script>
    <script src="/js/grid-layout.min.js"></script> 
    <script>
        var user_logged_in = {{ auth()->check() ? 'true' : 'false' }};
    </script>
    @stack('styles')
</head>
<body>
    <!--<div class="preload"></div>-->
    @include('home.header')
    @include('home.menu_standard')
    @include('home.menu_languages')
    @yield('content')
    @include('home.footer')
   
    @stack('scripts')      
</body>
</html>    