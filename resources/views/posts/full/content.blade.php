<a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
    class="t-excerpt c-negro" 
    data-id="{{ $post->id }}">
  @if ($post->isOffer() && $post->user_id <> auth()->id())
    <a class="button yellow">{{ __('messages.promoted-post') }}</a>
    <a class="button red">{{ __('messages.until') }} {{ $post->valid_until }}</a>
  @endif  
  @if ($post->kpost && $post->kpost->excerpt)
    {{ $post->kpost->excerpt }}
  @else
    {{ $post->excerpt }}
  @endif 
</a>