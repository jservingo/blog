{{-- catalogs.show --}} 

@extends('layout')

@section('content')
	@php
    $title = __('messages.created-catalogs');
    $root = "catalogs_ribbon";
    $category = null;
  @endphp

  <div>
    <div class="loader" style="float:left;"></div>

    <div id="main_panel" style="visibility:hidden;">
		  @include('catalogs.buttons_title')
			@include('catalogs.ribbon_view')
			{{ $catalogs->render("pagination::default") }}
		  {{-- $catalogs->links() --}}
    </div>

    <div style="clear: both;"></div>
  </div> 

  <div>
  	@foreach($catalogs as $catalog)
  		@foreach($catalog->posts as $post)
				@include('posts.buttons.box_popup_menu')
			@endforeach
		@endforeach	
	</div>						
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_ribbon.css?ver=1.11">
  <link rel="stylesheet" href="/css/multiselect.css">
@endpush

@push('scripts')
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
	<script type="text/javascript" src="/js/timezoneOffset.js"></script>
  <script type="text/javascript" src="/js/diyslider.min.js"></script>
	<script type="text/javascript" src="/js/confirmDialog.min.js"></script>
	<script type="text/javascript" src="/js/growl.js"></script>
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
  <script type="text/javascript" src="/js/fdate.js"></script>
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
    var iframe_width = 230;
  </script>
  <script type="text/javascript" src="/js/resize_iframe.js"></script>
	@include('catalogs.ribbon_script')  
	@include('home.message') 
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
      $(window).trigger('resize');
    });
  </script>
@endpush

