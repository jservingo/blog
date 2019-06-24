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
        
        @php $ad_text='Offers'; @endphp
        @include('home.post_ad')

        @php $ad_image='ads/ad1.jpg'; @endphp
        @include('home.post_ad_image')        

        {{-- 'Row 2' --}}

        @php $ad_text='Recomendations'; @endphp
        @include('home.post_ad')

        @php $ad_text='Favorites'; @endphp
        @include('home.post_ad')

        @php $ad_image='ads/ad3.jpg'; @endphp
        @include('home.post_ad_image')

        {{-- 'Row 3' --}}
        @php $ad_text='Most viewed by you'; @endphp
        @include('home.post_ad')

        @php $ad_text='Recently viewed'; @endphp
        @include('home.post_ad')

        @php $ad_image='ads/ad4.jpg'; @endphp
        @include('home.post_ad_image')

        {{-- 'Row 4' --}}

        @php $ad_image='ads/ad5.jpg'; @endphp
        @include('home.post_ad_image')

        @php $ad_image='ads/ad6.jpg'; @endphp
        @include('home.post_ad_image')

        @php $ad_image='ads/ad7.jpg'; @endphp
        @include('home.post_ad_image')

      </div>      
    </div>
  </div> 
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_ad.css">
  <!--<link rel="stylesheet" href="/css/multiselect.css">-->
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
    <script type="text/javascript" src="/js/buttons_add_save_discard.js"></script>
  <script type="text/javascript" src="/js/buttons_catalog_ribbon.js"></script>
  <script type="text/javascript" src="/js/buttons_copy_paste.js"></script>
  <script type="text/javascript" src="/js/buttons_create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons_delete.js"></script>
  <script type="text/javascript" src="/js/buttons_header.js"></script>
  <!--<script type="text/javascript" src="/js/jquery.multiselect.js"></script>-->
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
  @include('home.message')
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush






  	  