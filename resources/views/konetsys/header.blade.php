{{-- konetsys.header --}} 

<header>
    <div class="container-header-logo">
        <figure class="logo">
            <img src="/img/konetsys_logo_blanco.png" alt="">
        </figure>
    </div>        
    <div class="container-header-login container-flex">
        <div id="menu_languages" class="popr" data-id="languages"> 
            <img src="/img/{{ __('messages.lang') }}.png" alt="" style="width:22px;height:20px;">
        </div>   
        <a class="btn_login button blue" href="#">&nbsp;&nbsp;&nbsp;{{ __('messages.log-in') }}&nbsp;&nbsp;&nbsp;</a>
        <a class="btn_register button green" href="#">&nbsp;&nbsp;{{ __('messages.sign-up') }}&nbsp;&nbsp;</a>
    </div>
    <div style="clear: both"></div> 
</header>

