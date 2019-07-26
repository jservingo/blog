{{-- buttons.box_popup_menu --}}

<div class="popr-box" data-box-id="{{ $post->id }}">
@if ($root=="catalog")
	<div class="popr-item" data-btn="btn_edit_post" 
		data-id="{{ $post->id }}">
		Edit
	</div>
	<div class="popr-item" data-btn="btn_delete_post_from_catalog" 
		data-id="{{ $post->id }}" data-catalog="{{ $catalog->id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post"
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post"
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="page_category")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>
	<div class="popr-item" data-btn="btn_delete_post_from_created_pages" 
		data-id="{{ $post->id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post"
		data-id="{{ $post->id }}">Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post"
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="created_pages")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>
	@if ($post->user_id == auth()->id())
		<div class="popr-item" data-btn="btn_delete_post_from_created_pages" 
			data-id="{{ $post->id }}">
			Delete
		</div>  
	@else
		<div class="popr-item" data-btn="btn_delete_post_from_subscription"
			data-id="{{ $post->id }}">
			Unsubscribe
		</div>
	@endif
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="created_catalogs")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>	
	<div class="popr-item" data-btn="btn_delete_catalog_from_created_catalogs" 
		data-id="{{ $post->id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="created_apps")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>
	@if ($post->user_id == auth()->id())
		<div class="popr-item" data-btn="btn_delete_post_from_created_apps" 
			data-id="{{ $post->id }}">
			Delete
		</div>
	@else
		<div class="popr-item" data-btn="btn_delete_post_from_subscription"
			data-id="{{ $post->id }}">
			Unsubscribe
		</div>
	@endif
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif	
@elseif ($root=="subscriptions")
	<div class="popr-item" data-btn="btn_delete_post_from_subscription" 
		data-id="{{ $post->id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="app_subs")
	<div class="popr-item" data-btn="btn_edit_post" 
		data-id="{{ $post->id }}">
		Edit
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
			data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
			data-id="{{ $post->id }}"> 
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
			data-id="{{ $post->id }}"> 
		Save
	</div>
	@endif	
@elseif ($root=="app_pages")
	<div class="popr-item" data-btn="btn_edit_post"
			data-id="{{ $post->id }}">
		Edit
	</div>					
	<div class="popr-item" data-btn="btn_copy_post"
			data-id="{{ $post->id }}">
		Copy
	</div>
	<div class="popr-item" data-btn="btn_add_subscription"
			data-id="{{ $post->id }}">
		Subscribe 
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
			data-id="{{ $post->id }}"> 
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
			data-id="{{ $post->id }}"> 
		Save
	</div>
	@endif		
@elseif ($root=="contacts")
	<div class="popr-item" data-btn="btn_delete_post_from_contacts" 
		data-id="{{ $post->id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="contacts_group")
	<div class="popr-item" data-btn="btn_delete_post_from_contacts_group" 
		data-id="{{ $post->id }}" data-group="{{ $group_id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="received_posts")
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	<div class="popr-item" data-btn="btn_discard_post"
		data-id="{{ $post->id }}">
		Discard
	</div>
@elseif ($root=="sent_posts")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
@elseif ($root=="saved_posts")		
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>
	<div class="popr-item" data-btn="btn_discard_post" 
		data-id="{{ $post->id }}">
		Discard
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
@elseif ($root=="discarded_posts")		
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
@elseif ($root=="created_posts")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>
	<div class="popr-item" data-btn="btn_delete_post_from_created_posts" 
		data-id="{{ $post->id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="discover_apps")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	<div class="popr-item" data-btn="btn_add_subscription"
		data-id="{{ $post->id }}">
		Subscribe
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="discover_pages")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	<div class="popr-item" data-btn="btn_add_subscription"
		data-id="{{ $post->id }}">
		Subscribe
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="discover_catalogs")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="discover_users")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		Save
	</div>
	@endif
@elseif ($root=="edit_post")
  &nbsp;
@else
	{{ $root }}
@endif
</div>
