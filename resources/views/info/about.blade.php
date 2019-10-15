@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
		<div class="page page-about">
			<h1 class="text-capitalize">about</h1>
			<cite>Kodelia allows users to create and save posts created by other users. Organizing them in multiple catalogs, pages and powerfull aplications to easily share and find the information posted.</cite>
			<div class="divider-2" style="margin: 35px 0;"></div>
			<p>Designed & developed by Jorge Servín Gómez.</p>
			<p>Caracas, Venezuela.</p>
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
