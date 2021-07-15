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
	  	  height: "296px", // height of the slider
	  	  display: 4, // number of slides you want it to display at once
	  	  loop: false // disable looping on slides
		}); // this is all you need!

		$(".container").width(1040);
	@endforeach

	@php
		$i = 0;
	@endphp

	$(window).resize(function () {
		@foreach($catalogs as $catalog)
			@php
	    	$i = $i+1;
			@endphp
			if ($(window).width()<720)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "256px",
	    		display: 1
				});

				$(".container").width(256);			
			}
			if ($(window).width()>=720 && $(window).width()<960)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "512px",
	    		display: 2
				});

				$(".container").width(512);			
			}
			if ($(window).width()>=960 && $(window).width()<1200)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "768px",
	    		display: 3
				});		

				$(".container").width(768);
			}
			if ($(window).width()>=1200 && $(window).width()<1500)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1024px",
	    		display: 4
				});	

				$(".container").width(1024);
			}
			if ($(window).width()>=1500 && $(window).width()<1800)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1280px",
	    		display: 5
				});	

				$(".container").width(1280);
			}
			if ($(window).width()>=1800 && $(window).width()<2100)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1536px",
	    		display: 6
				});	

				$(".container").width(1536);
			}
			if ($(window).width()>=2100 && $(window).width()<2300)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1792px",
	    		display: 7
				});	

				$(".container").width(1792);
			}
			if ($(window).width()>=2300)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "2048px",
	    		display: 8
				});	

				$(".container").width(2048);
			}
	    //$("
	    //$("#jqxgrid").jqxGrid({ height: $(window).height() - 60 });
	    //$(".slider").diyslider("resize", "400px", "200px");
	  @endforeach
	});
</script>