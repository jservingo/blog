{{-- home.show_login --}} 

@extends('layout')

@section('content')
  <div style="margin:0">
    <img src="/img/kodelia_intro.png" style="width:100%;">
  </div>

  <div style="width:100%; background-color:#155597; margin-top:-26px;"> 
    <h1 style="padding-left:0px; padding-top:22px; padding-bottom:22px; color:#ffff; text-align:center;">
      {{ __('messages.introducing') }}
    </h1>
  </div>

  @include('home.presentation_value_proposition')
  @include('home.presentation_solutions')

  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  @if (session('warning'))
    <div class="alert alert-warning">
      {{ session('warning') }}
    </div>
  @endif    

  <div class="gradient-top">
    <div class="feature-right"><!-- style="float:right; width:46%; text-align:center;" -->
      <div style="width:100%; padding-top:40px; display:inline-block;">
        @if($mode=='login')
          @include('home.login_form')
        @else
          @include('home.register_form')
        @endif
      </div>
    </div> 

    <div class="feature-left"><!-- style="float:left; width:46%; padding-left:50px;" -->
			<div style="width:100%; padding-top:40px; display:inline-block;">
				@include('home.presentation_slider')
			</div>

		</div>

    <div style="clear: both;"></div>

    <div style="width:100%; text-align:center;">
    	<div style="width:100%; display:inline-block;">
    		@include('home.feature1')
        @include('home.feature2')
        @include('home.feature3')
        @include('home.feature4')
        @include('home.feature5')
    	</div>
  </div>  
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework.css?ver=1.11">
  <link rel="stylesheet" href="/css/formulario.css">
  <!--<link rel="stylesheet" href="/css/multiselect.css">-->
@endpush

@push('scripts')
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
  <script>
    $(document).ready(function() {
      $('.popr').popr();
      $("#menu_standard").hide();
    });
  </script> 
  @include('home.message')
@endpush
