{{-- home.show --}} 

@extends('layout')

@section('content')
  <div style="overflow: hidden; width:100%">
    
    <div class="loader"></div>

    <div id="main_panel" style="visibility:hidden;">
      @include('home.title')

      <div id="posts_container" class="posts container">
        {{-- 'Row 1' --}}

        @include('home.post_user_stats')

        @php 
          $route='home.show_offers';
          $title=__('messages.offers');
          $type='offers'; 
        @endphp
        @include('home.post')

        @php $ad_num="ad1"; @endphp
        @include('home.post_ad')        

        {{-- 'Row 2' --}}

        @php
          $route='home.show_recommendations';
          $title=__('messages.recommendations');
          $type='recommendations'; 
        @endphp
        @include('home.post')

        @php 
          $route='home.show_favorites';
          $title=__('messages.favorites'); 
          $type='favorites';
        @endphp
        @include('home.post')

        @php $ad_num="ad2"; @endphp
        @include('home.post_ad')

        {{-- 'Row 3' --}}
        @php 
          $route='home.show_most_viewed';
          $title=__('messages.most-viewed'); 
          $type='most_viewed';
        @endphp
        @include('home.post')

        @php 
          $route='home.show_recent_views';
          $title=__('messages.recently-viewed');
          $type='recently_viewed'; 
        @endphp
        @include('home.post')

        @php $ad_num="ad3"; @endphp
        @include('home.post_ad')

        {{-- 'Row 4' --}}

        @php $ad_num="ad4"; @endphp
        @include('home.post_ad')

        @php $ad_num="ad5"; @endphp
        @include('home.post_ad')

        @php $ad_num="ad6"; @endphp
        @include('home.post_ad')
      </div>      
    </div>
  </div> 
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_ad.css?ver=1.11">
  <!--<link rel="stylesheet" href="/css/multiselect.css">-->
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
  <script type="text/javascript" src="/js/timezoneOffset.js"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons/add_save_discard.js"></script>
  <script type="text/javascript" src="/js/buttons/catalog_ribbon.js"></script>
  <script type="text/javascript" src="/js/buttons/copy_paste_send.js"></script>
  <script type="text/javascript" src="/js/buttons/create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons/delete.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <!--<script type="text/javascript" src="/js/jquery.multiselect.js"></script>-->
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/fdate.js"></script>
  <script type="text/javascript" src="/js/jqsimplemenu.js"></script>
  <script type="text/javascript" src="/js/show_ads.js"></script> 
  <script type="text/javascript" src="/js/show_home.js"></script>  
  <script type="text/javascript" src="/js/truncate.js"></script>
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
  @include('home.message')
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush
 	  