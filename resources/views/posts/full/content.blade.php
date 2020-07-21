<a href="{{ route('post.show',[$post,\Illuminate\Support\Str::slug($post->title)]) }}"
    class="t-excerpt c-negro" 
    data-id="{{ $post->id }}">
  @if ($post->isOffer() && $post->user_id <> auth()->id())
    <span style="background-color:#F0E68C;padding:4px;">{{ __('messages.promoted-post') }}</span>
    <span style="background-color:#DC143C;color:#ffffff;padding:4px;">{{ __('messages.until') }} {{ $post->valid_until }}</span>
  @endif  
  @if ($post->kpost && $post->kpost->excerpt)
    {{ $post->kpost->excerpt }}
  @else
    {{ $post->excerpt }}
  @endif 
  @if ($post->audios->count() >= 1)
    <h3>{{ __('messages.audios') }}:</h3>
    @include('posts.single.audios')
  @endif
</a>