@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
		<div class="page page-about">
      <h1 class="text-capitalize">{{ __('messages.about') }}</h1>
			<h2>{{ __('messages.slogan') }}</h2>
      <h3>{{ __('messages.version') }}</h3>
			<cite>{{ __('messages.solution') }}</cite>
			<div class="divider-2" style="margin: 35px 0;"></div>
			<p>{{ __('messages.d&d') }}</p>
			<p>{{ __('messages.headquarters') }}</p>
		</div>
	</section>
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework.css">
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/jqsimplemenu.js"></script>
  <script>
    $(document).ready(function() {
      $('.popr').popr();
      $('.menu').jqsimplemenu();
      @if (! Auth::check())
     	  $("#menu_standard").hide();
    	@endif 
    });
  </script> 
  @include('home.message')
@endpush
