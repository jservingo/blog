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
      <a href="{{ route('post.show',$post) }}">
        {{ $post->type->name }}
      </a>
   </span>
  </div>
@endif
@if ($post->isWebPage())
  <div class="post-category">     
   <span class="category lime text-capitalize">
      <a href="{{ $post->url }}" target="_blank">
        {{ $post->type->name }}
      </a>
    </span>
  </div>
@endif
@if ($post->isOffer())
  <div class="post-category">
   <span class="category orange text-capitalize">
      <a href="{{ route('post.show',$post) }}">
        {{ $post->type->name }}
      </a>
    </span>
  </div>
@endif  
@if ($post->isCatalog())
  <div class="post-category">     
   <span class="category sepia text-capitalize">
      <a href="{{ route('catalog.show_catalog',$post->ref_id) }}">
        {{ $post->type->name }}
      </a>
    </span>
  </div>
@endif  
@if ($post->isPage())
  <div class="post-category">
	 <span class="category green text-capitalize">
  	  <a href="{{ route('page.show_page_category',[$post->ref_id,0]) }}">
         {{ $post->type->name }}
       </a>
    </span>
  </div>
@endif
@if ($post->isApp())
  <div class="post-category">
   <span class="category dark-wine text-capitalize">
      <a href="{{ route('app.show_app',[$post->ref_id,0]) }}">
        {{ $post->type->name }}
      </a>
    </span>
  </div>
@endif
@if ($post->isUser())
  <div class="post-category">    
   <span class="category azure text-capitalize">
      <a href="{{ route('post.show',$post) }}">
         {{ $post->type->name }}
      </a>
    </span>
  </div>
@endif
@if ($post->custom_type)
  <div class="post-category">
   <span class="category dark-wine text-capitalize">
      <a href="{{ route('app.show_app',[$post->ref_id,0]) }}">
        {{ $post->custom_type }}
      </a>
    </span>
  </div>
@endif
