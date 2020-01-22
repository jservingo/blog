{{-- home.show_login --}} 

@extends('layout')

@section('content')
  <div style="width:100%; background-color:#baf3e8; margin-top:-22px; height:180px">
    <h1 style="padding-left:60px; padding-top:22px">Save, organize and share your posts</h1>
    <p style="padding-left:60px;">
      <span style="font-size:24px; font-weight:500;">
        Kodelia allows you to create and save posts created by other users. Organizing them in multiple catalogs, and pages to easily find the information posted. Share, send and receive post. Use powerfull aplications that access data comming from external sources.
      </span>
    </p>
    <p style="padding-left:60px;">
      <span style="background-color:yellow; color:black; font-size:18px; font-weight:900;">
        &nbsp;&nbsp;Beta version 1.2.0&nbsp;&nbsp;
      </span>
    </p>
  </div>

  <div class="gradient-top">
    <div style="float:left; width:46%; padding-left:50px;">
			<div style="width:100%; padding-top:40px; display:inline-block;">
				@include('home.presentation_slider')
			</div>

		</div>

    <div style="float:right; width:46%; text-align:center;">
      <div style="width:90%; padding-top:40px; display:inline-block;">
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
    <script type="text/javascript" src="/js/buttons/add_save_discard.js"></script>
  <script type="text/javascript" src="/js/buttons/catalog_ribbon.js"></script>
  <script type="text/javascript" src="/js/buttons/copy_paste.js"></script>
  <script type="text/javascript" src="/js/buttons/create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons/delete.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
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
