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
    <link rel="stylesheet" href="/css/normalize.css">
    <!--<link rel="stylesheet" href="/css/framework.css">-->
    <link rel="stylesheet" href="/css/style.css">
    <!--<link rel="stylesheet" href="/css/responsive.css">-->
    <link rel="stylesheet" href="/css/confirmDialog.css">
    <link rel="stylesheet" href="/css/jquery.growl.css">
    <link rel="stylesheet" href="/css/buttons.css">
    <link rel="stylesheet" href="/css/popr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="/js/timezoneOffset.js"></script> 
    @stack('styles')
</head>
<body>
    <!--<div class="preload"></div>-->
    @yield('content')

    @stack('scripts')     
</body>
</html>    