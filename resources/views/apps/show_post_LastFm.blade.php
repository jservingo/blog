{{-- apps.show_post_lastFm --}} 

@extends('layout_popup')

@section('content')
  <div style="overflow: hidden;">

    <div class="loader"></div>

    <div id="main_panel" style="visibility:hidden;">
      <div id="posts_container" class="posts container">
        <div class="app-posts">
          <div class="app-loader"></div>
        </div>
      </div>      
    </div>
  </div> 
 
  <div id="app_posts_menu"></div>
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_full.css">
<style>
</style>
@endpush

@push('scripts')
  <script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="/js/buttons/add_save_discard.js"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>  
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script>
    var mbid = "{{ $mbid }}";
  </script>
  <script type="text/javascript" src="/js/apps/show_post_LastFm.js"></script>
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush
