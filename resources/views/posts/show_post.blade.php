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

        <div class="image-w-text" style="padding-right:20px;">
          <h3>Excerpt:</h3>
          @if ($post->kpost && $post->kpost->excerpt)
            {{ $post->kpost->excerpt }}
          @else
            {{ $post->excerpt }}
          @endif
        </div>

        <div class="image-w-text" style="padding-right:20px;">
          <h3>Content:</h3>
          {!! $post->body !!}
        </div>

        <div class="image-w-text links" style="padding-right:20px;">
           @if ($post->links)
            <h3>Links:</h3>
            {!! $post->links !!}
           @endif
        </div>

        <div class="image-w-text" style="padding-right:20px;">
          @if ($post->kpost && $post->kpost->observation)
            <h3>Observation:</h3>
            {{ $post->kpost->observation }}
          @else
            {{ $post->observation }}
          @endif
        </div>

        <div class="image-w-text" style="padding-right:20px;">
          @if ($post->kpost && $post->kpost->footnote)
            <h3>Footenote:</h3>
            {{ $post->kpost->footnote }}
          @else
            {{ $post->footnote }}
          @endif
        </div>

        <div class="image-w-text" style="padding-right:20px;">
          @if ($post->tags)
            <h3>Tags:</h3>
            @include('posts.box.tags')
          @endif
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
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
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
    var post_id = {{ $post->id }}; 
    var type_id = {{ $post->type_id }};
    var type = get_type(type_id);

    if (type=="Page")
    {
      $.ajax({
        url: '/page/stats/'+post_id,
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#p_catalogs').text('('+data+')');
        },
        error: function (data) {
          console.log('Error:', data);
        }
      }); 
    }

    if (type=="Catalog")
    {
      $.ajax({
        url: '/catalog/stats/'+post_id,
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#c_posts').text('('+data+')');
        },
        error: function (data) {
          console.log('Error:', data);
        }
      }); 
    }

    if (type=="User")
    {
      $.ajax({
        url: '/contacts/stats/'+post_id,
        dataType: 'json',
        success: function(data) {
          $('#u_apps').text('('+data.apps+')');
          $('#u_pages').text('('+data.pages+')');
          $('#u_catalogs').text('('+data.catalogs+')');
          $('#u_posts').text('('+data.posts+')');
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
  </script>
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script> 
@endpush