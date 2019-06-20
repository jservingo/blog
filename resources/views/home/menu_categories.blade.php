{{-- home.menu_categories --}}

@if ($root=="contacts" || $root=="contacts_group")
  @include('contacts.menu')   
@elseif ($root=="page_category")
  @include('pages.menu')
@endif