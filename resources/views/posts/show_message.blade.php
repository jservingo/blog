@php
	if ($root=="page_category")
	{
		$msg_title = __('messages.category-empty');
		$msg_subtitle = __('messages.category-advice');
	}
	else if ($root=="catalog")
	{
		$msg_title = __('messages.catalog-empty');
		$msg_subtitle = __('messages.catalog-advice');
	}
  else if ($root=="contacts")
	{
		$msg_title = __('messages.contacts-empty');
		$msg_subtitle = __('messages.contacts-advice');
	}
  else if ($root=="received_posts")
	{
		$msg_title = __('messages.received-empty');
		$msg_subtitle = __('messages.received-advice');
	}
  else if ($root=="notifications")
	{
		$msg_title = __('messages.notifications-empty');
		$msg_subtitle = __('messages.notifications-advice');
	}
	else if ($root=="alerts")
	{
		$msg_title = __('messages.alerts-empty');
		$msg_subtitle = __('messages.alerts-advice');
	}
  else if ($root=="sent_posts")
	{
		$msg_title = __('messages.sent-empty');
		$msg_subtitle = __('messages.sent-advice');
	}
  else if ($root=="saved_posts")
	{
		$msg_title = __('messages.saved-empty');
		$msg_subtitle = __('messages.saved-advice');
	}
  else if ($root=="discarded_posts")
	{
		$msg_title = __('messages.discarded-empty');
		$msg_subtitle = __('messages.discarded-advice');
	}
  else if ($root=="created_apps")
	{
		$msg_title = __('messages.created-apps-empty');
		$msg_subtitle = __('messages.created-apps-advice');
	}
	else if ($root=="app_pages")
	{
		$msg_title = __('messages.app-pages-empty');
		$msg_subtitle = __('messages.app-pages-advice');
	}
  else if ($root=="created_pages")
	{
		$msg_title = __('messages.created-pages-empty');
		$msg_subtitle = __('messages.created-pages-advice');
	}
  else if ($root=="created_catalogs")
	{
		$msg_title = __('messages.created-catalogs-empty');
		$msg_subtitle = __('messages.created-catalogs-advice');
	}
  else if ($root=="created_posts")
	{
		$msg_title = __('messages.created-posts-empty');
		$msg_subtitle = __('messages.created-posts-advice');
	}
  else if ($root=="discover_apps")
	{
		$msg_title = __('messages.apps-empty');
		$msg_subtitle = __('messages.apps-advice');
	}
	else if ($root=="discover_pages")
	{
		$msg_title = __('messages.pages-empty');
		$msg_subtitle = __('messages.pages-advice');
	}
	else if ($root=="discover_catalogs")
	{
		$msg_title = __('messages.catalogs-empty');
		$msg_subtitle = __('messages.catalogs-advice');
	}
	else if ($root=="discover_users")
	{
		$msg_title = __('messages.users-empty');
		$msg_subtitle = __('messages.users-advice');
	}
  else if ($root=="all_apps")
	{
		$msg_title = __('messages.all-apps-empty');
		$msg_subtitle = __('messages.all-apps-advice');
	}
  else if ($root=="all_pages")
	{
		$msg_title = __('messages.all-pages-empty');
		$msg_subtitle = __('messages.all-pages-advice');
	}
  else if ($root=="all_catalogs")
	{
		$msg_title = __('messages.all-catalogs-empty');
		$msg_subtitle = __('messages.all-catalogs-advice');
	}
  else if ($root=="subscriptions_apps")
	{
		$msg_title = __('messages.app-subscriptions-empty');
		$msg_subtitle = __('messages.app-subscriptions-advice');
	}
  else if ($root=="subscriptions_pages")
	{
		$msg_title = __('messages.page-subscriptions-empty');
		$msg_subtitle = __('messages.page-subscriptions-advice');
	}
	else if ($root=="app_subscribers")
	{
		$msg_title = __('messages.app-subscribers-empty');
		$msg_subtitle = __('messages.app-subscribers-advice');
	}
  else if ($root=="page_subscribers")
	{
		$msg_title = __('messages.page-subscribers-empty');
		$msg_subtitle = __('messages.page-subscribers-advice');
	}
  else
  {
  	$msg_title = $root;
	  $msg_subtitle = "oops";
	}  
@endphp

<div style="width:90%; background-color:#fbfdf1; padding:10px; margin-bottom:20px;">
	<h4>{{ $msg_title }}</h4>
	<p>{{ $msg_subtitle }}</p>
</div>