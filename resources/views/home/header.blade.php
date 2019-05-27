{{-- home.header --}} 

<header class="space-inter">
    <div class="container-header container-flex space-between" style="align-items:center;">
        <div class="container-flex" style="align-items:center;">
            <figure class="logo">
                <img src="/img/kodelia_logo.png" alt="">
            </figure>
            <span id="logoFont" style="padding-left:5px;">Kodelia</span>
        </div>
        <div>
            <div class="searchWrap">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        @if (auth()->check())
            <div class="container-flex space-between" style="width:210px;">
                {{ Auth::user()->name }}
                <a class="btn_configuration"> 
                    <img src="/img/configuration.png" alt="" style="width:20px;height:20px;">
                </a>
                <a class="btn_notifications">    
                    <img src="/img/bell.png" alt="" style="width:20px;height:20px;">
                </a>
                <div id="menu_profile" class="popr" data-id="profile">
                  <img src="/img/profile.png" width="20" />
                </div>
                <div style="width:10px">&nbsp;</div>
            </div>
        @else
            <div class="container-flex" style="align-items:center;">
                <a class="btn_login button blue" href="#">Iniciar sesión</a>
                <a class="btn_register button green" href="#">Regístrate</a>
            </div>
        @endif
    </div>
    @include('home.menu_profile')
    @include('home.menu_view_posts')
    @include('home.menu_view_catalogs')
</header>
