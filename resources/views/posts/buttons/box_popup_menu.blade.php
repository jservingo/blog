{{-- buttons.box_popup_menu --}}

<div class="popr-box" data-box-id="{{ $post->id }}">
@if ($root=="catalog")
	<div class="popr-item" data-btn="btn_edit_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>
	<div class="popr-item" data-btn="btn_delete_post_from_catalog" 
		data-id="{{ $post->id }}" data-catalog="{{ $catalog->id }}">
		{{ __('messages.tip-delete') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="page_category")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>
	<div class="popr-item" data-btn="btn_delete_catalog_from_category" 
		data-id="{{ $post->id }}"
		data-category="{{ $category->id }}">
		{{ __('messages.tip-delete') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post"
		data-id="{{ $post->id }}">Forward
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="created_pages" || $root=="all_pages")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>
	@if ($post->user_id == auth()->id())
		<div class="popr-item" data-btn="btn_delete_post_from_created_pages" 
			data-id="{{ $post->id }}">
			{{ __('messages.tip-delete') }}
		</div>  
	@else
		<div class="popr-item" data-btn="btn_delete_post_from_subscription"
			data-id="{{ $post->id }}">
			{{ __('messages.tip-unsubscribe') }}
		</div>
	@endif
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="created_catalogs" || $root=="all_catalogs")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>	
	<div class="popr-item" data-btn="btn_delete_catalog_from_created_catalogs" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-delete') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="created_apps" || $root=="all_apps")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>
	@if ($post->user_id == auth()->id())
		<div class="popr-item" data-btn="btn_delete_post_from_created_apps" 
			data-id="{{ $post->id }}">
			{{ __('messages.tip-delete') }}
		</div>
	@else
		<div class="popr-item" data-btn="btn_delete_post_from_subscription"
			data-id="{{ $post->id }}">
			{{ __('messages.tip-unsubscribe') }}
		</div>
	@endif
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif	
@elseif ($root=="subscriptions" || $root=="subscriptions_apps" || $root=="subscriptions_pages")
	<div class="popr-item" data-btn="btn_delete_post_from_subscription" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-delete') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="app_subs")
	<div class="popr-item" data-btn="btn_edit_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
			data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
			data-id="{{ $post->id }}"> 
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
			data-id="{{ $post->id }}"> 
		{{ __('messages.tip-save') }}
	</div>
	@endif	
@elseif ($root=="app_pages")
	<div class="popr-item" data-btn="btn_edit_post"
			data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>					
	<div class="popr-item" data-btn="btn_copy_post"
			data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	<div class="popr-item" data-btn="btn_add_subscription"
			data-id="{{ $post->id }}">
		{{ __('messages.tip-subscribe') }} 
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
			data-id="{{ $post->id }}"> 
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
			data-id="{{ $post->id }}"> 
		{{ __('messages.tip-save') }}
	</div>
	@endif		
@elseif ($root=="contacts")
	<div class="popr-item" data-btn="btn_delete_post_from_contacts" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-delete') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_message" 
		data-id="{{ $post->user_id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="contacts_group")
	<div class="popr-item" data-btn="btn_delete_post_from_contacts_group" 
		data-id="{{ $post->id }}" data-group="{{ $group_id }}">
		{{ __('messages.tip-delete') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_message" 
		data-id="{{ $post->user_id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="received_posts" || $root=="notifications" || $root=="alerts")
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	<div class="popr-item" data-btn="btn_discard_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-discard') }}
	</div>
@elseif ($root=="sent_posts")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
@elseif ($root=="saved_posts")		
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>
	<div class="popr-item" data-btn="btn_discard_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-discard') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
@elseif ($root=="discarded_posts")		
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
@elseif ($root=="created_posts" || $root=="tag_posts")
	<div class="popr-item" data-btn="btn_edit_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-edit') }}
	</div>
	<div class="popr-item" data-btn="btn_delete_post_from_created_posts" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-delete') }}
	</div>
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="discover_apps")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	<div class="popr-item" data-btn="btn_add_subscription"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-subscribe') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="discover_pages")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	<div class="popr-item" data-btn="btn_add_subscription"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-subscribe') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="discover_catalogs")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="discover_users")
	<div class="popr-item" data-btn="btn_copy_post"
		data-id="{{ $post->id }}">
		{{ __('messages.tip-copy') }}
	</div>
	@if ($post->kpost)
	<div class="popr-item" data-btn="btn_send_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-send-post') }}
	</div>
	@else
	<div class="popr-item" data-btn="btn_save_post" 
		data-id="{{ $post->id }}">
		{{ __('messages.tip-save') }}
	</div>
	@endif
@elseif ($root=="edit_post")
  &nbsp;
@else
	{{ $root }}
@endif
</div>
