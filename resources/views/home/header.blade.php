{{-- home.header --}} 

<header class="space-inter">
    <div class="container-header container-flex space-between" style="align-items:center;">
        <div class="container-flex" style="align-items:center;">
            <figure class="logo">
                <img src="/img/kodelia_logo.png" alt="">
            </figure>
        </div>        
        @if (auth()->check())
            <div class="container-flex">
                <div class="searchWrap">
                    <div class="search">
                        <input type="text" class="searchTerm" placeholder="{{ __('messages.search') }}">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div style="width:400px; text-align:right;">
                <span class="user-header">
                    <a id="t-user" href="/user/{{ Auth::user()->id }}">
                        {{ Auth::user()->name }}
                    </a>
                </span>
            </div>        
            <div class="container-flex space-between" style="width:130px;">                
                <div id="menu_languages" class="popr" data-id="languages"> 
                    <img src="/img/{{ __('messages.lang') }}.png" alt="" style="width:22px;height:20px;">
                </div>    
                <a class="btn_show_alerts">    
                    <img src="/img/bell.png" alt="" style="width:20px;height:20px;">
                </a>            
                <a class="btn_configuration"> 
                    <img src="/img/configuration.png" alt="" style="width:20px;height:20px;">
                </a>                
                <div id="menu_profile" class="popr" data-id="profile">
                  <img src="/img/profile.png" width="20" />
                </div>
                <div style="width:10px">&nbsp;</div>
            </div>
        @else
            <div class="container-flex" style="align-items:center;">
                <div id="menu_languages" class="popr" data-id="languages"> 
                    <img src="/img/{{ __('messages.lang') }}.png" alt="" style="width:22px;height:20px;">
                </div>   
                <a class="btn_login button blue" href="#">&nbsp;&nbsp;&nbsp;{{ __('messages.log-in') }}&nbsp;&nbsp;&nbsp;</a>
                <a class="btn_register button green" href="#">&nbsp;&nbsp;{{ __('messages.sign-up') }}&nbsp;&nbsp;</a>
            </div>
        @endif
    </div>
    @include('home.menu_profile')
    @include('home.menu_view_posts')
    @include('home.menu_view_catalogs')
</header>

