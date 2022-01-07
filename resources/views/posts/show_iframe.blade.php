{{-- posts.show_iframe --}} 

@extends('layout_iframe')

@section('content')
  <div class="grid-container">
		{!! $post->iframe !!} 
  </div>
  <div class="grid-excerpt">
    <p>{{ $post->excerpt }}</p>
  </div> 
@endsection

@push('styles')
  <style>
  body {
  	width: 500px;
  	min-width:500px;
    background-color: #000
  }
  .grid-container { 
    width: 500px;
    height: auto;
    margin: 0;
    padding: 0;
    background-color: #000
  }  
  .grid-excerpt { 
    width: 460px;
    height: auto;
    padding: 10px;
    background-color: #000
  }
  .grid-excerpt > p {
    color:#BFEFFF;
  } 
  </style>
@endpush

@push('scripts')
  <script>
    var iframe_width = 500;
  </script>
  <script type="text/javascript" src="/js/resize_iframe.js"></script>
@endpush