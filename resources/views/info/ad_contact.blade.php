@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
@extends('layout')
		<div id="main_panel" class="page page-about">
      <h1 class="text-capitalize">{{ __('messages.ad-contact') }}</h1>
			<div>
        <figure class="xlogo" style="margin:0">
          <img src="/img/kodelia_slogan.png" style="height:90px;" alt="kodelia_slogan">
        </figure>
      </div>
      <p>Please contact sales for more info</p>
      <h3>{{ __('messages.send-message') }} {{ __('messages.sales') }}
				<a class="btn_send_message" data-id="16"> 
					<img src="/img/send_message.png" width="24" style="margin-top:-5px;">
				</a>
			</h3>		
		</div>
	</section>
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework.css?ver=1.11">
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
