<a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
    class="t-excerpt c-negro" 
    data-id="{{ $post->id }}">
  @if ($post->kpost && $post->kpost->excerpt)
    {{ $post->kpost->excerpt }}
  @else
    {{ $post->excerpt }}
  @endif 
</a>