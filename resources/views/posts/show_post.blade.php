{{-- posts.show_post --}} 

@php
  include(app_path() . '/functions/box_options.php');
  $zcolor="#fefdfd";
@endphp

@extends('layout')

@section('page-title',$post->title)
@section('page-description',$post->excerpt)

@section('content')
  <div style="overflow:hidden; padding-left:30px;">
    <div class="loader"></div>

    <div id="header_panel" style="visibility:hidden;">  
      <div class="container" style="margin:0;">  
         @include('posts.single.header') 
      </div>
    </div>

    <div style="width:95%;">
    <div id="main_panel" style="float:left; width:70%; visibility:hidden;">  
      <div class="container" style="margin:0;">                 
        @include('posts.single.owner')
        @include('posts.single.content')
        @include('posts.single.body')
        @include('posts.single.options')      
      </div>      
    </div>

    <div id="ads_panel" style="float:right; width:30%; visibility:hidden;">  
      <div class="container" style="margin:0;">  
         @include('posts.single.ads') 
      </div>
    </div>

    <div style="clear: both;"></div>
    </div>
  </div> 
@endsection

@push('styles')
  <!--<link rel="stylesheet" href="/css/twitter-bootstrap.css">-->
  <link rel="stylesheet" href="/css/framework_single.css">
  <link rel="stylesheet" href="/css/audioPlayer.min.css">
@endpush

@push('scripts')
	<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>  
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/jqsimplemenu.js"></script>
  <script type="text/javascript" src="/js/audioPlayer.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('.menu').jqsimplemenu();
    });
  </script>
  <script>
    $(document).ready(function() {
     $('.popr').popr();
     $('.tip').tipr();
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
  <script type="text/javascript" src="/js/save_recent_views.js"></script>
  <!--<script src="/js/twitter-bootstrap.js"></script>--> 
  <script type="text/javascript" src="/js/show_ads.js"></script> 
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
      $('#header_panel').css("visibility","visible");
      $('#main_panel').css("visibility","visible");
      $('#ads_panel').css("visibility","visible");
    });
  </script> 
  <script>
    $(function() {
      @if ($post->first_audio != '') 
        var url = "{{ $post->first_audio }}";      
        var player = $.AudioPlayer;
              
        player.init({
              container: '#audioWrap'
              ,source: url
              ,imagePath: '/image'
              ,debuggers: false
              ,allowSeek: true        
        });

        $('[data-url]').on('click', function(event) {
            event.preventDefault();
            url = $(this).data('url');

            player.updateSource({
                source: url
            });
        });
      @endif
    });
  </script>    
@endpush