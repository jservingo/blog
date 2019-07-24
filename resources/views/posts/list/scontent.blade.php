<div class="scontent"  
			style="width:304px; background-color:{{ $zcolor }}; padding:8px 10px;">
  <a href="{{ route('post.show_post',$post) }}"
      class="t-excerpt c-negro" 
      data-id="{{ $post->id }}">
    @if ($post->kpost && $post->kpost->excerpt)
    	{{ $post->kpost->excerpt }}
  	@else
    	{{ $post->excerpt }}
  	@endif 
  </a>
</div>