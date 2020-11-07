{{-- pages.show_category --}} 

@extends('layout')

@inject('provider', 'App\Http\Controllers\CatalogsController')

@section('content')
	@php
    $title = $page->name; 
    $root = "page_category";
    $subtitle = $category->name;
  @endphp 

	<div>
		<div class="loader" style="float:left;"></div>

    @include('pages.menu')

		<div id="main_panel" style="visibility:hidden;">
			@include('pages.buttons_title')
			@include('pages.buttons_subtitle')
			@include('catalogs.ribbon_view')
      
			{{ $catalogs->render("pagination::default") }}
  		{{-- $catalogs->links() --}}
		</div>
	</div>

	<div>
    @foreach($catalogs as $catalog)
      @php
        $posts =  $provider::get_posts($catalog->id);
      @endphp
      @foreach($posts as $post)
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
  <script
	  src="https://code.jquery.com/jquery-3.3.1.min.js"
	  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	  crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>
	<script type="text/javascript" src="/js/diyslider.min.js"></script>
	@php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
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
  <script>
    var page_id = {{ $page->id }};
    @if ($reset_categories_tree)
      var reset_categories_tree = true;
    @else
      var reset_categories_tree = false; 
    @endif
  </script>
	<script type="text/javascript" src="/js/categoriesTree.js"></script>
  <script type="text/javascript" src="/js/buttons/categories.js"></script>
	<script> 
    var rv_type_id = 22; 
    var rv_post_id = 0;
    var rv_ref_id = {{ $page->id }};
  </script> 
  <script type="text/javascript" src="/js/save_recent_views.js"></script>
	@include('catalogs.ribbon_script')  
	@include('home.message')
	<script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush