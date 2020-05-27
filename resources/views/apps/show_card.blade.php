{{-- apps.show_app_card --}} 

@extends('layout')

@section('content')
  <div style="overflow: hidden;">

    <!--<div class="loader"></div>-->

    <div id="main_panel" style="visibility:hidden;">
      @include('apps.title')
      {{-- @include('apps.show_app_rows') --}}
      <div id="posts_container" class="posts container">
        <div class="app-posts" style="display:flex; flex-wrap:wrap">
          <div class="loader"></div>
        </div>
        <div class="pagination-holder clearfix">
          <div id="light-pagination"></div>
        </div>
      </div>      
      {{-- $posts->render("pagination::default") --}}
      {{-- $posts->links() --}}
    </div>
  </div> 
 
  <div id="app_posts_menu"></div>
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_card.css">
  <link rel="stylesheet" href="/css/multiselect.css">
  <link rel="stylesheet" href="/css/simplePagination.css" >
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>
  <!--
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.solodev.com/assets/pagination/jquery.twbsPagination.js"></script>
  -->
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
  <script type="text/javascript" src="/js/simplePagination.js"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script>
    var app_id = {{ $app->id }};
    var owner_name = "{{ $app->owner->name }}";
    var owner_post = "{{ $app->owner->post->id }}"; 
    var truncate_js = true;      
  </script>
  <script type="text/javascript" src="/js/apps/search_{{ $app->name }}.js"></script>
  <script type="text/javascript" src="/js/apps/show_card.js"></script>    
  <script type="text/javascript" src="/js/buttons/add_save_discard.js"></script>
  <script type="text/javascript" src="/js/buttons/catalog_ribbon.js"></script>
  <script type="text/javascript" src="/js/buttons/copy_paste_send.js"></script>
  <script type="text/javascript" src="/js/buttons/create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons/delete.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="/js/multiselect.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/tipr.js"></script>
  <script type="text/javascript" src="/js/truncate.js"></script>
  <script type="text/javascript" src="/js/jqsimplemenu.js"></script>
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
    var iframe_width = 174;
  </script>
  <script type="text/javascript" src="/js/resize_iframe.js"></script>
  @include('home.message')
  <script> 
    var rv_type_id = 23; 
    var rv_post_id = 0;
    var rv_ref_id = app_id;
  </script> 
  <script type="text/javascript" src="/js/save_recent_views.js"></script>
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush