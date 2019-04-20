{{-- catalogs.ribbon_script --}}

<script type="text/javascript">		
	@php
		$i = 0;
	@endphp

	@foreach($catalogs as $catalog)
		@php
    	$i = $i+1;
		@endphp
		
		$("#slider{{ $i }}").diyslider({
	  	  width: "1024px", // width of the slider
	  	  height: "340px", // height of the slider
	  	  display: 4, // number of slides you want it to display at once
	  	  loop: false // disable looping on slides
		}); // this is all you need!
	@endforeach

	@php
		$i = 0;
	@endphp

	$(window).resize(function () {
		@foreach($catalogs as $catalog)
			@php
	    	$i = $i+1;
			@endphp
			if ($(window).width()<768)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "300px",
	    		display: 1
				});			
			}
			if ($(window).width()>=768 && $(window).width()<992)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "540px",
	    		display: 2
				});			
			}
			if ($(window).width()>=992 && $(window).width()<1200)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "800px",
	    		display: 3
				});			
			}
			if ($(window).width()>=1200)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1040px",
	    		display: 4
				});			
			}
	    //$("#jqxgrid").jqxGrid({ height: $(window).height() - 60 });
	    //$(".slider").diyslider("resize", "400px", "200px");
	  @endforeach
	});
</script>