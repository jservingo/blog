<div class="scontent"  
			style="width:304px; background-color:{{ $zcolor }}; padding:2px 10px 10px 10px; text-align:justify;">
  <a href="{{ route('post.show_post',$post) }}"
      class="t-excerpt c-negro" 
      data-id="{{ $post->id }}">
    {{ $post->excerpt }}
  </a>
</div>