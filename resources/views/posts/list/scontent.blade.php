<div class="scontent"  
			style="width:304px; background-color:{{ $zcolor }}; padding:8px 10px;">
  <a href="{{ route('post.show_post',$post) }}"
      class="t-excerpt c-negro" 
      data-id="{{ $post->id }}">
    {{ $post->excerpt }}
  </a>
</div>