{{-- posts.box.header --}}

{{-- D6EDF9 --}}
@if (!isset($zcolor))
  @php ($zcolor="#d7e9f3")
@endif

<header class="xcontainer-flex xspace-between">
	<div class="date truncate" data-height="51" style="width:215px; padding:10px 5px 5px 10px; background-color:{{ $zcolor }}">
    @include('posts.box.featured')
		<a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
				class="text-uppercase c-blue"
	  		data-id="{{ $post->id }}">
	  	<h1 class="t-title" style="margin-top:0;margin-bottom:0px;margin-right:22px;">{{ $post->title }}</h1>
		</a>		
	  <div> 
	    <div class="popr box_popup" style="position:absolute; top:10px; right:10px;"
	        data-id="{{ $post->id }}">
	      <img src="/img/options.png" width="20" />
	    </div> 
	  </div> 
  </div>
  @include('posts.box.type')
</header>