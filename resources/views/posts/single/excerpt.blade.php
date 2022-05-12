<div style="background-color:#2662DF; color:white; padding:10px; margin-top:10px; border:10px solid #7FB3D5;font-family:cursive; font-size:20px;">
  @if ($post->kpost && $post->kpost->excerpt)
    {{ $post->kpost->excerpt }}
  @else
    {{ $post->excerpt }}
  @endif
</div>