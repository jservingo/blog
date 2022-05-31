{{-- posts.show_post --}} 

@php
  include(app_path() . '/functions/box_options.php');
  $zcolor="#fefdfd";
@endphp

@extends('layout')

@section('page-title',$post->title)
@section('page-description',$post->excerpt)

@section('content')
  <div style="overflow:hidden; width:100%;">
    <div class="loader"></div>

    <div id="header_panel" style="visibility:hidden;">  
      <div class="container" style="margin:0;">  
         @include('posts.single.header') 
      </div>
    </div>    

    <div id="details_panel" style="visibility:hidden;">
      <div id="owner_panel">  
        <div class="container" style="margin:0;">
          @include('posts.single.owner')
        </div>  
      </div>

      <div id="links_panel">  
        <div class="container" style="margin:0;">
          @include('posts.single.links')
        </div>
      </div>

      <div style="clear: both;"></div> 
    </div>

    <div style="width:100%;">
      <div id="main_panel" style="visibility:hidden; margin-top:5px;">  
        <div class="container" style="margin:0;">                 
          @include('posts.single.excerpt')
          @include('posts.single.content')
          @include('posts.single.body')
          @include('posts.single.options')      
        </div>      
      </div>

      <div id="ads_panel" style="visibility:hidden;">  
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
  <link rel="stylesheet" href="/css/framework_single.css?ver=1.13">
  <link rel="stylesheet" href="/mathML/mathml-formula/fmathFormula.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/default.min.css">
@endpush

@push('scripts')
	<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
  <script type="text/javascript" src="/js/timezoneOffset.js"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/buttons/create_edit_show.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/tipr.js"></script>
  <script type="text/javascript" src="/js/fdate.js"></script>
  <script type="text/javascript" src="/js/kpub.js"></script>
  <script type="text/javascript" src="/js/jqsimplemenu.js"></script>
  <script type="text/javascript" src="/js/audio.min.js"></script>
  <script type="text/javascript" src="/epub/epub.js"></script>
  <script type="text/javascript" src="/mathML/mathml-formula/fonts/fmathFormulaFonts.js"></script>
  <script type="text/javascript" src="/mathML/mathml-formula/menu/basicContext.min.js"></script>
  <script type="text/javascript" src="/mathML/mathml-formula/fmathFormulaC.js"></script>
  <script type="text/javascript" src="/mathML/crossBrowserSolution.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
  <script type="text/javascript">
    hljs.highlightAll();
  </script>  
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
  <script type="text/javascript" src="/js/resize_iframe_single.js"></script>
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

    if (type=="App")
    {
      $.ajax({
        url: '/app/stats/'+post_id,
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#a_subscriptions').text(data);
        },
        error: function (data) {
          console.log('Error:', data);
        }
      }); 
    }

    if (type=="Page")
    {
      $.ajax({
        url: '/page/stats/'+post_id,
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#p_catalogs').text('('+data.catalogs+')');
          $('#p_subscriptions').text(data.subscriptions);
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
    if (type=="EPUB")
    {
      var source = $("#epub").data("source"); 
      var book = ePub(source);
      var rendition = book.renderTo("epub", {method:"continuous", flow:"scrolled", width:600, height:400});
      rendition.display();
    }
  </script>
  <script>
    $(function() {
      fMathSolutionProcess();
    });
  </script>  
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#header_panel').css("visibility","visible");
      $('#details_panel').css("visibility","visible");
      $('#main_panel').css("visibility","visible");
      $('#ads_panel').css("visibility","visible");
    });
  </script> 
  <script>
    $(function() {
      $('audio').initAudioPlayer();
    });
  </script>    
@endpush