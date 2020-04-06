{{-- home.footer --}} 

<section class="footer">
    <footer>
        <div class="container" style="display:block">
            <nav>
                <ul class="container-flex space-center list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-uppercase c-white">{{ __('messages.home') }}</a></li>
                    <li><a href="{{ route('info.about') }}" class="text-uppercase c-white">{{ __('messages.about') }}</a></li>
                    <li><a href="{{ route('info.support') }}" class="text-uppercase c-white">{{ __('messages.donate') }}</a></li>
                    <li><a href="{{ route('info.contact') }}" class="text-uppercase c-white">{{ __('messages.contact') }}</a></li>
                </ul>
            </nav>
            <div class="divider-2"></div>
            <p style="font-size:18px">{{ __('messages.solution') }}</p>
            <div class="divider-2" style="width: 80%;"></div>
            <p style="opacity:1">{{ __('messages.d&d') }}</p>
            <p>Copyright © 2020 kodelia.com {{ __('messages.all-rights') }}</p>            
            <ul class="social-media-footer list-unstyled">
                <li><a href="#" class="fb"></a></li>
                <li><a href="#" class="tw"></a></li>
                <li><a href="#" class="in"></a></li>
                <li><a href="#" class="pn"></a></li>
            </ul>
        </div>
    </footer>
</section>
