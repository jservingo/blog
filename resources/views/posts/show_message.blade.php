@php
	if ($root=="page_category")
	{
		$msg_title = "This category doesn't have catalogs.";
		$msg_subtitle = "You can create or paste a catalog.";
	}
  else if ($root=="contacts")
	{
		$msg_title = "This lists doesn't have contacts.";
		$msg_subtitle = "You can discover and paste a contact.";
	}
  else if ($root=="received_posts")
	{
		$msg_title = "You have not received posts.";
		$msg_subtitle = "";
	}
  else if ($root=="notifications")
	{
		$msg_title = "You have not received notifications.";
		$msg_subtitle = "";
	}
	else if ($root=="alerts")
	{
		$msg_title = "You have not received alerts.";
		$msg_subtitle = "";
	}
  else if ($root=="sent_posts")
	{
		$msg_title = "You have not sent posts.";
		$msg_subtitle = "";
	}
  else if ($root=="saved_posts")
	{
		$msg_title = "You have not saved posts.";
		$msg_subtitle = "";
	}
  else if ($root=="discarded_posts")
	{
		$msg_title = "You have not discarded posts.";
		$msg_subtitle = "";
	}
  else if ($root=="created_apps")
	{
		$msg_title = "You have not created apps.";
		$msg_subtitle = "Sorry! This option is not implemented yet.";
	}
  else if ($root=="created_pages")
	{
		$msg_title = "You have not created pages.";
		$msg_subtitle = "You can create a page by using the add button.";
	}
  else if ($root=="created_catalogs")
	{
		$msg_title = "You have not created catalogs.";
		$msg_subtitle = "You can create a catalog by using the add button.";
	}
  else if ($root=="created_posts")
	{
		$msg_title = "You have not created posts.";
		$msg_subtitle = "You can create a post by using the add button.";
	}
  else if ($root=="all_apps")
	{
		$msg_title = "You have not created or subscribed to any app.";
		$msg_subtitle = "You can subscribe to any app by discovering first.";
	}
  else if ($root=="all_pages")
	{
		$msg_title = "You have not created or subscribed to any page.";
		$msg_subtitle = "You can create a page or you can subscribe to any page by discovering first.";
	}
  else if ($root=="all_catalogs")
	{
		$msg_title = "You have not created or saved any catalog.";
		$msg_subtitle = "You can create a catalog or you can save any catalog from any page.";
	}
  else if ($root=="subscriptions_apps")
	{
		$msg_title = "You have not subscribed to any app.";
		$msg_subtitle = "You can subscribe to any app by discovering first.";
	}
  else if ($root=="subscriptions_pages")
	{
		$msg_title = "You have subscribed to any page.";
		$msg_subtitle = "You can subscribe to any page by discovering first.";
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