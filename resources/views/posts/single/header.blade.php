<div style="width:98%; padding-right:20px;"> 
	<h1>{{ $post->type->name }} {{ $post->title }}</h1>

	<div class="image-w-text">
	  {{ $post->owner->name }}
	</div>

	<div class="image-w-text">
	  Fecha de publicación: {{ $post->published_at->format('d M Y')}}
	</div>      

	@if ($post->kpost)
	  <div class="image-w-text">
	    Enviado por:  {{ $post->sender->name }}
	  </div>
	@endif  
</div>