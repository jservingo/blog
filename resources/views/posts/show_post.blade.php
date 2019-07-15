{{-- posts.show_post --}} 

@php
  include(app_path() . '/functions/box_options.php')
@endphp

@php ($zcolor="#fefdfd")

@extends('layout')

@section('page-title',$post->title)
@section('page-description',$post->excerpt)

@section('content')
  <div style="overflow:hidden; padding-left:30px;">
    <div class="loader"></div>

    <div id="main_panel" style="visibility:hidden;">  
      <div class="container" style="margin:0;">          
        @include('posts.single.header') 
        @include('posts.single.content')

        <div class="container-flex space-between" style="width:98%;padding:20px 20px 20px 0;">
          @include('posts.box.tags')
        </div>

        <div class="image-w-text" style="padding-right:20px;">
          {!! $post->excerpt !!}
        </div>

        <div class="image-w-text" style="padding:20px 20px 20px 0;">
          {!! $post->body !!}
        </div>

        @include('posts.single.options')
        
        {{-- 
        <div class="comments">
          <div class="divider"></div>
          <div id="disqus_thread"></div>
          @include('partials.disqus-scripts')
        </div><!-- .comments -->
        --}}        
      </div>      
    </div>
  </div> 
@endsection

@push('styles')
  <!--<link rel="stylesheet" href="/css/twitter-bootstrap.css">-->
  <link rel="stylesheet" href="/css/framework_single.css">
@endpush

@push('scripts')
	<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>  
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons_header.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/jqsimplemenu.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('.menu').jqsimplemenu();
    });
  </script>
  <script>
    $(document).ready(function() {
     $('.popr').popr();
    });
  </script> 
  <script>
    var iframe_width = 600;
  </script>
  <script type="text/javascript" src="/js/resize_iframe.js"></script>
  <script> 
    var rv_type_id = {{ $post->type_id }}; 
    var rv_post_id = {{ $post->id }};
    var rv_ref_id = {{ $post->ref_id ? $post->ref_id : 0 }};
  </script> 
  <script type="text/javascript" src="/js/saveCookieRecentViews.js"></script>
  <!--<script src="/js/twitter-bootstrap.js"></script>--> 
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script> 
@endpush