{{-- buttons.box_post --}}

@if ($root=="catalog")
	<a class="btn_edit_post" 
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>				
	<a class="btn_delete_post_from_catalog" 
			data-id="{{ $post->id }}" 
			data-catalog="{{ $catalog->id }}">
		<img src="/img/delete.png" width="24" />
	</a>
	<a class="btn_copy_post"
	    data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="created_catalogs" || $root=="all_catalogs")
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>				
	<a class="btn_delete_catalog_from_created_catalogs" 
			data-id="{{ $post->id }}">
		<img src="/img/delete.png" width="24" />
	</a>
	<a class="btn_copy_post"
	    data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="page_category")
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>				
	<a class="btn_delete_catalog_from_category" 
			data-id="{{ $post->id }}"
			data-category="{{ $category->id }}"> 
		<img src="/img/delete.png" width="24" />
	</a>
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="created_pages" || $root=="all_pages")
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>				
	@if ($post->user_id == auth()->id())
		<a class="btn_delete_post_from_created_pages" 
				data-id="{{ $post->id }}"> 
			<img src="/img/delete.png" width="24" />
		</a>	
	@else
		<a class="btn_delete_post_from_subscription"
				data-id="{{ $post->id }}">
			<img src="/img/delete.png" width="24" />
		</a>
	@endif	
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="created_apps" || $root=="all_apps")
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>				
	@if ($post->user_id == auth()->id())
		<a class="btn_delete_post_from_created_apps" 
				data-id="{{ $post->id }}"> 
			<img src="/img/delete.png" width="24" />
		</a>
	@else
		<a class="btn_delete_post_from_subscription"
				data-id="{{ $post->id }}">
			<img src="/img/delete.png" width="24" />
		</a>
	@endif
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif	
@elseif ($root=="subscriptions" || $root=="subscriptions_apps" || $root=="subscriptions_pages")
	<a class="btn_delete_post_from_subscription" 
			data-id="{{ $post->id }}"> 
		<img src="/img/delete.png" width="24" />
	</a>	
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="app_subs")
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>	
	<a class="btn_delete_app_subs"
			data-id="{{ $post->id }}">
		<img src="/img/delete.png" width="24" />
	</a>			
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif	
@elseif ($root=="app_pages")
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>					
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	<a class="btn_add_subscription"
			data-id="{{ $post->id }}">
		<img src="/img/subscribe.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif	
@elseif ($root=="contacts")
    <a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>
	<a class="btn_delete_post_from_contacts" 
			data-id="{{ $post->id }}"> 
		<img src="/img/delete.png" width="24" />
	</a>	
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_message" 
			data-id="{{ $post->user_id }}"> 
		<img src="/img/mail.png" width="24" />
	</a>
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="contacts_group")
	<a class="btn_delete_post_from_contacts_group" 
			data-id="{{ $post->id }}"
			data-group="{{ $group_id }}"> 
		<img src="/img/delete.png" width="24" />
	</a>	
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_message" 
			data-id="{{ $post->user_id }}"> 
		<img src="/img/mail.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="received_posts" || $root=="notifications" || $root=="alerts")
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	<a class="btn_discard_post"
			data-id="{{ $post->id }}">
		<img src="/img/delete.png" width="24" />
	</a>	
@elseif ($root=="sent_posts")	
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>		
@elseif ($root=="saved_posts")		
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>				
	<a class="btn_discard_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/delete.png" width="24" />
	</a>
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
@elseif ($root=="discarded_posts")		
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
@elseif ($root=="created_posts" || $root=="tag_posts")
	<a class="btn_edit_post"
			data-id="{{ $post->id }}">
		<img src="/img/edit.png" width="24" />
	</a>				
	<a class="btn_delete_post_from_created_posts" 
			data-id="{{ $post->id }}"> 
		<img src="/img/delete.png" width="24" />
	</a>
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif
@elseif ($root=="discover_apps")
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	<a class="btn_add_subscription"
			data-id="{{ $post->id }}">
		<img src="/img/subscribe.png" width="24" />
	</a>	
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif	
@elseif ($root=="discover_pages")
    <a class="btn_allocate_app"
			data-id="{{ $post->id }}"
			app_id="{{ $post->app_id }}">
		<img src="/img/allocate.png" width="24" />
	</a>
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	<a class="btn_add_subscription"
			data-id="{{ $post->id }}">
		<img src="/img/subscribe.png" width="24" />
	</a>	
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif		
@elseif ($root=="discover_catalogs")
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif	
@elseif ($root=="discover_users")
	<a class="btn_copy_post"
			data-id="{{ $post->id }}">
		<img src="/img/copy.png" width="24" />
	</a>
	@if ($post->kpost)
	<a class="btn_send_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/send.png" width="24" />
	</a>
	@else
	<a class="btn_save_post" 
			data-id="{{ $post->id }}"> 
		<img src="/img/save.png" width="24" />
	</a>
	@endif			
@elseif ($root=="edit_post")
  &nbsp;
@else
	{{ $root }}
@endif

@if ($post->user_likes == 0)
<a class="btn_update_likes" 
		data-id="{{ $post->id }}"
		data-mode="up"> 
	<img src="/img/likes_white.png" width="24" />
</a>
@else
<a class="btn_update_likes" 
		data-id="{{ $post->id }}"
		data-mode="down"> 
	<img src="/img/likes_red.png" width="24" />
</a>
@endif

<?php 
	$likes = format_num($post->likes);
?>

<span id="likes">{{ $likes }}</span>
