@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
		<div class="page page-about">
      <h1 class="text-capitalize">{{ __('messages.account') }}</h1>		
			<h2>{{ $user->post->title }}</h2>
			<p>{{ __('messages.username') }}: {{ $user->name }}</p>
			<p>{{ __('messages.email') }}: {{ $user->email }}</p>
			<p>{{ __('messages.language') }}: {{ $user->language }}</p>
			<p>{{ __('messages.creation-date') }}: {{ $user->post->created_date }}</p>
      <p>{{ __('messages.views') }}: {{ $user->post->views }}</p>
			<p>{{ __('messages.likes') }}: {{ $user->post->likes }}</p>
		</div>
	</section>
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework.css?ver=1.9">
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/buttons/create_edit_show.js"></script>
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