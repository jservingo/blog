{{-- home.menu --}}

@if ($root=="contacts" || $root=="contacts_group")
  @include('contacts.menu')   
@elseif ($root=="page_catalogs_posts")
  @include('pages.menu')
@endif