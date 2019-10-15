@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
		<div class="page page-archive">
			<h1 class="text-capitalize">support</h1>
			<p>If you want to make a donation to this startup, your name will appear in this page. Please, help us to continue growth. We thank you in advance.</p>
			<div class="divider-2" style="margin: 35px 0;"></div>
			<div class="container-flex space-between">
				<div class="authors-categories">
					<h3 class="text-capitalize">Donators</h3>
					<ul class="list-unstyled">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
					{{--
					<h3 class="text-capitalize">categories</h3>
					<ul class="list-unstyled">
						<li class="text-capitalize">i do travel</li>
						<li class="text-capitalize">i do observe</li>
						<li class="text-capitalize">i do photos</li>
						<li class="text-capitalize">i do watch</li>
						<li class="text-capitalize">i do listen</li>
						<li class="text-capitalize">i do quote</li>
						<li class="text-capitalize">i do explore</li>
					</ul>
					--}}
				</div>
				<div class="latest-posts">
					<h3 class="text-capitalize">Account</h3>
					<p>.</p>
					<p>.</p>
					<p>.</p>
					{{--
					<h3 class="text-capitalize">posts by month</h3>
					<ul class="list-unstyled">
						<li>August 2015</li>
						<li>September 2015</li>
						<li>October 2015</li>
					</ul>
					--}}
				</div>
			</div>
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
