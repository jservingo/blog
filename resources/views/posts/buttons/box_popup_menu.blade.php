{{-- box_popup_menu.blade.php --}}

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
@elseif ($root=="created_catalogs")
	<div class="popr-item" data-btn="btn_edit_post"
	  data-id="{{ $post->id }}">
	  Edit
	</div>
	<div class="popr-item" data-btn="btn_delete_post_from_catalog"
		data-id="{{ $post->id }}" data-catalog="{{ $catalog->id }}">
		Delete
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">Copy
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post"
		data-id="{{ $post->id }}">
		Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post"
		data-id="{{ $post->id }}">Save
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
	<div class="popr-item" data-btn="btn_delete_post_from_created_pages" 
		data-id="{{ $post->id }}">
		Delete
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
@elseif ($root=="created_apps")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>
	<div class="popr-item" data-btn="btn_delete_post_from_created_apps" 
		data-id="{{ $post->id }}">
		Delete
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

	<div class="popr-item" class="btn_copy_post"
			data-id="{{ $post->id }}">
		Copy
	</div>
	
	@if ($post->kpost)
	<div class="popr-item" class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		Sent
	</div>
	@else
	<div class="popr-item" class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		Save
	</div>
	@endif	
@elseif ($root=="app_pages")
	<div class="popr-item" class="btn_edit_post"
			data-id="{{ $post->id }}">
		Edit
	</div>				
	
	<div class="popr-item" class="btn_copy_post"
			data-id="{{ $post->id }}">
		Copy
	</div>

	<div class="popr-item" class="btn_add_subscription"
			data-id="{{ $post->id }}">
		Subscribe
	</a>
	
	@if ($post->kpost)
	<div class="popr-item" class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		Sent
	</a>
	@else
	<div class="popr-item" class="btn_save_post" 
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
		Delete
	</div>
@elseif ($root=="saved_posts")		
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		Edit
	</div>
	<div class="popr-item" data-btn="btn_discard_post" 
		data-id="{{ $post->id }}">
		Delete
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
@elseif ($root=="edit_post")
  &nbsp;
@else
	buttons_box_post: {{ $root }}
@endif
</div>
