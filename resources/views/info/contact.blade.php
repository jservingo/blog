@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
		<div id="main_panel" class="page page-contact">
			<h1 class="text-capitalize">{{ __('messages.contact-us') }}</h1>
			<h3>{{ __('messages.need-help') }}</h3>
			<div class="divider-2" style="margin:25px 0;"></div>	
			<h3>{{ __('messages.send-message') }} {{ __('messages.support') }} 
				<a class="btn_send_message" data-id="15"> 
					<img src="/img/send_message.png" width="24" style="margin-top:-5px;">
				</a>
			</h3>		
			<h3>{{ __('messages.send-message') }} {{ __('messages.sales') }}
				<a class="btn_send_message" data-id="16"> 
					<img src="/img/send_message.png" width="24" style="margin-top:-5px;">
				</a>
			</h3>		
			<h3>{{ __('messages.send-message') }} {{ __('messages.admin') }}
				<a class="btn_send_message" data-id="14"> 
					<img src="/img/send_message.png" width="24" style="margin-top:-5px;">
				</a>
			</h3>	
			<h3>WhatsApp +58(424)2618854</h3>
		</div>
	</section>
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework.css?ver=1.8">
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="/js/buttons/create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons/copy_paste_send.js"></script>
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
