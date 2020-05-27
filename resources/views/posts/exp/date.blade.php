{{-- posts.box.date --}}

{{-- D6EDF9 --}}
@if (!isset($zcolor))
  @php ($zcolor="#d7e9f3")
@endif

<div class="truncate" data-height="18" style="width:440px; background-color:#fefdfd; padding:4px 10px 4px 10px; text-align:right;">
    <span class="user c-blue">
      <a href="{{ route('post.show',[$post->owner_post,\Illuminate\Support\Str::slug($post->owner->name)]) }}">
        {{ $post->owner->name }}
      </a>
      @if ($post->owner->id != auth()->id()) 
        <a class="btn_add_user_to_contacts" 
            data-id="{{ $post->owner->id }}">
          <img src="/img/add_user.png" width="14" />
        </a>
      @endif 
      {{-- 
      @if ($post->kpost)
        <a href="{{ route('post.show',$post->sender_post) }}">
          {{ $post->sender->name }}
        </a>
      @endif
      --}}
      &nbsp;
    </span>
    <span class="c-gray-1" style="font-size:14px">
      {{ $post->published_date }}
    </span>
</div>
