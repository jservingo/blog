{{-- catalogs.show --}} 

@extends('layout')

@section('content')
	@php
    $title = "Created catalogs";
    $root = "created_catalogs";
    $category = null;
  @endphp

  <div>
    @include('home.menu')

    <div class="loader" style="float:left;"></div>

    <div id="main_panel" style="float:right;visibility:hidden;">
		  @include('catalogs.title')
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
  <link rel="stylesheet" href="/css/framework_ribbon.css">
  <link rel="stylesheet" href="/css/multiselect.css">
@endpush

@push('scripts')
  <script
	  src="https://code.jquery.com/jquery-3.3.1.min.js"
	  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	  crossorigin="anonymous"></script>
	<script type="text/javascript" src="/js/diyslider.min.js"></script>
	<script type="text/javascript" src="/js/confirmDialog.min.js"></script>
	<script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons_add_save_discard.js"></script>
  <script type="text/javascript" src="/js/buttons_catalog_ribbon.js"></script>
  <script type="text/javascript" src="/js/buttons_copy_paste.js"></script>
  <script type="text/javascript" src="/js/buttons_create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons_delete.js"></script>
  <script type="text/javascript" src="/js/buttons_header.js"></script>
  <script type="text/javascript" src="/js/multiselect.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/truncate.js"></script>
  <script>
    $(document).ready(function() {
     $('.popr').popr();
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
    });
  </script>
@endpush

