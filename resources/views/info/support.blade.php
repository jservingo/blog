@extends('layout')

@section('content')
  <br/>
	<section class="pages container">
		<div class="page page-archive">
			<h1 class="text-capitalize">{{ __('messages.donate') }}</h1>
			<h3>{{ __('messages.send-donation') }}</h3>
			<div class="divider-2" style="margin: 35px 0;"></div>
			<div>
				<h3 class="text-capitalize">{{ __('messages.accounts') }}</h3>
				<div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
					  <h3>Paypal</h3>
						<img src="/img/paypal.jpg" width="200">
						<p><a href="https://www.paypal.me/jservingo">paypal.me/jservingo</a><p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
					  <h3>Airtm</h3>
						<img src="/img/airtm-logo.png" width="200">
						<p>Email: jservingo@gmail.com<p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
					  <h3>Pipol Pay - Facebank</h3>
						<img src="/img/pipolpay.png" width="200">
						<p>Email: jservingo@gmail.com<p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
					  <h3>Zelle</h3>
						<img src="/img/zelle.png" width="200">
						<p>Sorry! Zelle is not working anymore in Venezuela</a><p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
						<h3>Citibank-USA (USD)</h3>
						<p>Name: Jorge E. Servin.</p>
						<p>Account No.: 86692318</p>
						<p>Routing Number: 021000089</p>
						<p>Bank Address: CITIBANK, N.A. BR. #22
						<br>399 PARK AVENUE
						<br>NEW YORK, NY 10043
						<br>USA</p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
					  <h3>Trust Wallet - Bitcoin</h3>
						<img src="/img/bc1qgt7qvptt9l8k3xntcgwxq8qka787ty8yx8sasw.png" width="200">
						<p>bc1qgt7qvptt9l8k3xntcgwxq8qka787ty8yx8sasw<p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
					  <h3>Trust Wallet - Dash</h3>
						<img src="/img/XuzLYpbLrnK618yFDH5TwBbfDJN686zXvC.png" width="200">
						<p>XuzLYpbLrnK618yFDH5TwBbfDJN686zXvC<p>
					</div>					
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
						<h3>Banco Provincial (Bs)</h3>
						<p>Nombre: Jorge Servin</p>
						<p>Cuenta: 01080034020100042024</p>
						<p>CI: 5966618</p>
						<p>Email: jservingo@gmail.com</p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
						<h3>Banesco (Bs)</h3>	
						<p>Nombre: Jorge Servin</p>
						<p>Cuenta: 01340032690322051921</p>
						<p>CI: 5966618</p>
						<p>Email: jservingo@gmail.com</p>
					</div>
					<div style="float:left;width:350px;height:330px;background-color:#e2e2e2;margin-right:10px;margin-bottom:20px;">
						<h3>Mercantil (Bs)</h3>	
						<p>Nombre: Jorge Servin</p>
						<p>Cuenta: 01050080010080393624</p>
						<p>CI: 5966618</p>
						<p>Email: jservingo@gmail.com</p>
					</div>
					<div style="clear:both;"></div>
				</div>
				{{--
				<h3 class="text-capitalize">posts by month</h3>
				<ul class="list-unstyled">
					<li>August 2015</li>
					<li>September 2015</li>
					<li>October 2015</li>
				</ul>
				--}}
			</div>
			<div>
				<h3 class="text-capitalize">{{ __('messages.donators') }}</h3>
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
