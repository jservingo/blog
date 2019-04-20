{{-- apps.show --}} 

@extends('layout')

@section('content')
  <div style="overflow: hidden;">
    @include('home.menu')

    <div class="loader" style="float:left;"></div>

    <div id="main_panel" style="float:right;visibility:hidden;">
      @include('apps.title')
      {{-- @include('apps.show_app_rows') --}}
      <div id="posts_container" class="posts container">
        <div class="app-posts">
          <div class="app-loader"></div>
        </div>
        <div class="pagination-holder clearfix">
          <div id="light-pagination"></div>
        </div>
      </div>      
      {{-- $posts->render("pagination::default") --}}
      {{-- $posts->links() --}}
    </div>

    <div style="clear: both"></div>
  </div> 

  {{-- 
  <div>
    @foreach($rows as $row)
      @include('apps.box_popup_menu')    
    @endforeach      
  </div>
  --}}   
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_full.css">
  <link rel="stylesheet" href="/css/framework_app.css">
  <link rel="stylesheet" href="/css/multiselect.css">
  <link rel="stylesheet" href="/css/simplePagination.css" >
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
  <!--
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.solodev.com/assets/pagination/jquery.twbsPagination.js"></script>
  -->
  <script type="text/javascript" src="/js/simplePagination.js"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script>
    var app_id = {{ $app->id }};
    var owner_name = "{{ $app->owner->name }}";
    var owner_post = "{{ $app->owner->post->id }}";
  </script>
  <script type="text/javascript" src="/js/show_app_wrapper.js"></script>
  <script type="text/javascript" src="/js/buttons_header.js"></script>
  <script type="text/javascript" src="/js/buttons_add_save_discard.js"></script>
  <script type="text/javascript" src="/js/multiselect.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/truncate.js"></script>
  <script>
    $(document).ready(function() {
     $('.popr').popr();
    });
  </script>  
  <script>
    var iframe_width = 174;
  </script>
  <script type="text/javascript" src="/js/resize_iframe.js"></script>
  @include('home.message')
  <script>
    var width_container = $(window).width() - 380; 
    $(".container").width(width_container);
    $(".post").each(function() {
      var width_post = width_container - 60;
      var width_header = $(this).find(".header").width();
      var width_media = $(this).find(".media").width();
      var width_content = width_post - width_media - 60;
      var width_scontent = width_post - width_media - 28;
      var width_footnote = width_post - 260;
      $(this).width(width_post);
      $(this).find(".content").width(width_content);
      $(this).find(".scontent").width(width_content);
      $(this).find(".footnote").width(width_footnote);
    });
    
    $(window).resize(function () {
      var width_container = $(window).width() - 380; 
      $(".container").width(width_container);      
      $(".post").each(function() {
        var width_post = width_container - 60;
        var width_header = $(this).find(".header").width();
        var width_media = $(this).find(".media").width();
        var width_content = width_post - width_media - 60;
        var width_scontent = width_post - width_media - 28;
        var width_footnote = width_post - 260;
        $(this).width(width_post);
        $(this).find(".content").width(width_content);
        $(this).find(".scontent").width(width_content);
        $(this).find(".footnote").width(width_footnote);
      });
    });
  </script>
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush