{{-- konetsys.message --}}

@if (Session::has('message'))
	<script type='text/javascript'>
	@if (session('msgtype')=="error")	
		$.growl.error({ message:"{{ session('message') }}"});
	@elseif (session('msgtype')=="notice")
		$.growl.notice({ message:"{{ session('message') }}"});
	@elseif (session('msgtype')=="warning")
		$.growl.warning({ message:"{{ session('message') }}"});
	@endif
	</script>
@endif