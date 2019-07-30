<div style="width:95%; padding-right:20px;"> 
	<h1>{{-- $post->type->name --}} {{ $post->title }}</h1>

	<div class="image-w-text">
	  Owner: {{ $post->owner->name }}
	</div>

	<div class="image-w-text">
	  Publication date: {{ $post->published_at->format('d M Y')}}
	</div>      

	@if ($post->kpost)
	  <div class="image-w-text">
	    Sent by:  {{ $post->sender->name }}
	  </div>
	@endif  
</div>