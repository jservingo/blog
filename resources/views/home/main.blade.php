{{-- home.show --}} 

@extends('layout')

@section('content')
  <div class="gradient-top">
		<ul>
		<li>Received (#)</li>
		<li>Notifications (#)</li>
		<li>Subscribers
			<ul>
				<li>Apps (#)</li>
				<li>Pages (#)</li>
			</ul>
		</li>
		<li>Subscriptions
			<ul>
			  <li>Apps (#)</li>
				<li>Pages (#)</li>
			</ul>
		</li>
		<li>Most viewd by you (Apps, pages, catalogs, users)</li>
		<li>Recomendations (Apps, pages, catalogs, users)</li>
		<li>Recently viewed</li> 		  	
  </div>  
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework.css">
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
  <script type="text/javascript" src="/js/menu_header.js"></script>
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
@endpush






  	  