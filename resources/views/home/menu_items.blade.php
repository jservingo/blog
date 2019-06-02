{{-- home.menu_items --}}

<ul class="menu" style="position:absolute; z-index:999999;">
  <li><a href="http://www.kodelia.com">Home</a></li>

  <li><a href="#">My Stuff</a>
  <ul>
  <li>
    <a class="vlink" href="{{ route('apps.show_created') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Apps
    </a>
  </li>  
  <li>
    <a class="vlink" href="{{ route('pages.show_created') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Pages
    </a>
  </li>    
  <li>
    <a class="vlink" href="{{ route('catalogs.show_created') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Catalogs
    </a>
  </li>  
  <li>
    <a class="vlink" href="{{ route('posts.show_created') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Posts
    </a>
  </li>   
  </ul>
  </li>

  <li>
    <a class="vlink" href="{{ route('pages.show_subscriptions') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Subscriptions
    </a>
  </li>

  <li><a href="#">Discover</a>
  <ul>
  <li>
    <a class="vlink" href="{{ route('apps.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Apps
    </a>
  </li>  
  <li>
    <a class="vlink" href="{{ route('pages.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Pages
    </a>
  </li>    
  <li>
    <a class="vlink" href="{{ route('catalogs.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Catalogs
    </a>
  </li> 
  <li>
    <a class="vlink" href="{{ route('contacts.discover') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Users
    </a>
  </li> 
  </ul>
  </li> 

  <li>
    <a class="vlink" href="{{ route('contacts.show_contacts') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Contacts
    </a>
  </li> 

  <li><a href="#">Messages</a>
  <ul>       
	<li>
		<a class="vlink" href="{{ route('posts.show_received',0) }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Received 
    </a>
  </li>
    <li>
    <a class="vlink" href="{{ route('posts.show_sent',2) }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Sent 
    </a>
  </li>  
  <li>
    <a class="vlink" href="{{ route('posts.show_received',2) }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Saved 
    </a>
  </li>
  <li>
    <a class="vlink" href="{{ route('posts.show_received',1) }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Discarded 
    </a>
  </li>
  </ul>
  </li>
  
  <li>
    <a class="vlink" href="{{ route('posts.show_recent') }}" 
      class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRoute('pages.contact') }}">
        Recently viewed
    </a>
  </li>  
</ul>