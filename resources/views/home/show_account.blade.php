@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
		<div class="page page-about">
      <h1 class="text-capitalize">{{ __('messages.account') }}</h1>		
			<h2>{{ $user->post->title }}</h2>
			<p>username: {{ $user->name }}</p>
			<p>email: {{ $user->email }}</p>
			<p>language: {{ $user->language }}</p>
			<p>created_at: {{ $user->post->created_date }}</p>
      <p>views: {{ $user->post->views }}</p>
			<p>likes: {{ $user->post->likes }}</p>
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