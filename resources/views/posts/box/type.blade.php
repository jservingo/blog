@php
  $url = \Illuminate\Support\Str::slug($post->title);
@endphp
@if ($post->isPhotoGallery())
  <!-- Nothing -->
@endif
@if ($post->isFrame())
  <!-- Nothing -->
@endif
@if ($post->isText())
  <!-- Nothing -->
@endif
@if ($post->isNotification())
  <div class="post-category">
   <span class="category yellow text-capitalize">
      <a href="{{ route('post.show',[$post,$url]) }}">
        {{ __('messages.type-notification') }}
      </a>
   </span>
  </div>
@endif
@if ($post->isWebPage())
  <div class="post-category">     
   <span class="category lime text-capitalize">
      <a href="{{ $post->url }}" target="_blank">
        {{ __('messages.type-web-page') }}
      </a>
    </span>
  </div>
@endif
@if ($post->isAlert())
  <div class="post-category">
   <span class="category red text-capitalize">
      <a href="{{ route('post.show',[$post,$url]) }}">
        {{ __('messages.type-alert') }}
      </a>
    </span>
  </div>
@endif 
@if ($post->isOffer())
  <div class="post-category">
   <span class="category light-green text-capitalize">
      <a href="{{ route('post.show',[$post,$url]) }}">
        {{ __('messages.type-offer') }}
      </a>
    </span>
  </div>
@endif
@if ($post->isCustom())
  <div class="post-category">
   <span class="category dark-wine text-capitalize">
      {{-- route('app.show_app',[$post->ref_id,0,$url]) --}}
      <a href="{{ $post->source }}" target="_blank">
        {{ $post->custom_type }}
      </a>
    </span>
  </div>
@endif  
@if ($post->isMessage())
  <div class="post-category">
   <span class="category ocre text-capitalize">
      <a href="{{ route('post.show',[$post,$url]) }}">
        {{ __('messages.type-message') }}
      </a>
    </span>
  </div>
@endif 
@if ($post->isCatalog())
  <div class="post-category">     
   <span class="category sepia text-capitalize">
      <a href="{{ route('catalog.show_catalog',[$post->ref_id,$url]) }}">
        {{ __('messages.type-catalog') }}
      </a>
    </span>
  </div>
@endif  
@if ($post->isPage())
  <div class="post-category">
	 <span class="category green text-capitalize">
  	  <a href="{{ route('page.show_page_category',[$post->ref_id,0,$url]) }}">
         {{ __('messages.type-page') }}
       </a>
    </span>
  </div>
@endif
@if ($post->isApp())
  <div class="post-category">
   <span class="category dark-wine text-capitalize">
      <a href="{{ route('app.show_app',[$post->ref_id,$url]) }}">
        {{ __('messages.type-app') }}
      </a>
    </span>
  </div>
@endif
@if ($post->isUser())
  <div class="post-category">    
   <span class="category azure text-capitalize">
      <a href="{{ route('post.show',[$post,$url]) }}">
         {{ __('messages.type-user') }}
      </a>
    </span>
  </div>
@endif