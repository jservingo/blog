{{-- home.menu_items --}}

<ul class="menu" style="position:absolute; z-index:999999;">
  <li><a href="{{ route('home') }}">{{ __('messages.dashboard') }}</a></li>

  <li><a href="#">{{ __('messages.my-stuff') }}</a>
  <ul>
    <li><a href="#">{{ __('messages.messages') }}</a>
    <ul>        
      <li>
        <a class="vlink" href="{{ route('posts.show_received',0) }}" 
          class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
            {{ __('messages.received') }} 
        </a>
      </li>
        <li>
        <a class="vlink" href="{{ route('posts.show_sent',2) }}" 
          class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
            {{ __('messages.sent') }} 
        </a>
      </li>  
      <li>
        <a class="vlink" href="{{ route('posts.show_received',2) }}" 
          class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
            {{ __('messages.saved') }} 
        </a>
      </li>
      <li>
        <a class="vlink" href="{{ route('posts.show_received',1) }}" 
          class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
            {{ __('messages.discarded') }} 
        </a>
      </li>
    </ul>
    </li>
    <li>
      <a class="vlink" href="{{ route('contacts.show_contacts') }}" 
        class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
          {{ __('messages.contacts') }}
      </a>
    </li> 
    <li>
      <a class="vlink" href="{{ route('apps.show_all') }}" 
        class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
          {{ __('messages.apps') }}
      </a>
    </li>  
    <li>
      <a class="vlink" href="{{ route('pages.show_all') }}" 
        class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
          {{ __('messages.pages') }}
      </a>
    </li>    
    <li>
      <a class="vlink" href="{{ route('catalogs.show_all') }}" 
        class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
          {{ __('messages.catalogs') }}
      </a>
    </li>  
    <li>
      <a class="vlink" href="{{ route('posts.show_all') }}" 
        class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
          {{ __('messages.posts') }}
      </a>
    </li> 
    {{-- 
    <li>
      <a class="vlink" href="{{ route('subscriptions.show') }}" 
        class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
          {{ __('messages.subscriptions') }}
      </a>
    </li>
    --}}   
  </ul>
  </li>

  <li><a href="#">{{ __('messages.discover') }}</a>
  <ul>
  <li>
    <a class="vlink" href="{{ route('apps.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        {{ __('messages.apps') }}
    </a>
  </li>  
  <li>
    <a class="vlink" href="{{ route('pages.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        {{ __('messages.pages') }}
    </a>
  </li>    
  <li>
    <a class="vlink" href="{{ route('catalogs.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        {{ __('messages.catalogs') }}
    </a>
  </li> 
  <li>
    <a class="vlink" href="{{ route('contacts.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        {{ __('messages.users') }}
    </a>
  </li> 
  </ul>
  </li> 
</ul>