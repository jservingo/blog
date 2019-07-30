{{-- home.show_login --}} 

@extends('layout')

@section('content')
  <h1 style="padding-left:60px;">Save, organize and share your posts</h1>
  <p style="padding-left:60px;"> Beta version 1.0, July 27 2019</p>
  <div class="gradient-top">
    <div style="float:left; width:56%; text-align:center;">
			<div style="width:100%; padding-top:40px; display:inline-block;">
				@include('home.presentation_slider')
			</div>

		</div>

    <div style="float:right; width:40%; text-align:center;">
      <div style="width:100%; padding-top:40px; display:inline-block;">
      	@if($mode=='login')
      		@include('home.login_form')
      	@else
      		@include('home.register_form')
      	@endif
      </div>
    </div>

    <div style="clear: both;"></div>

    <div style="width:100%; text-align:center;">
    	<div style="width:100%; padding-top:40px; display:inline-block;">
    		@include('home.presentation_features')
    	</div>
  </div>  
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework.css">
  <link rel="stylesheet" href="/css/formulario.css">
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
  <script>
    $(document).ready(function() {
      $('.popr').popr();
      $("#menu_standard").hide();
    });
  </script> 
  @include('home.message')
@endpush
