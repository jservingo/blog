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
			if ($(window).width()<768)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "270px",
	    		display: 1
				});

				$(".container").width(300);			
			}
			if ($(window).width()>=768 && $(window).width()<960)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "540px",
	    		display: 2
				});

				$(".container").width(540);			
			}
			if ($(window).width()>=960 && $(window).width()<1200)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "810px",
	    		display: 3
				});		

				$(".container").width(810);
			}
			if ($(window).width()>=1200 && $(window).width()<1600)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1080px",
	    		display: 4
				});	

				$(".container").width(1080);
			}
			if ($(window).width()>=1600 && $(window).width()<1900)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1350px",
	    		display: 5
				});	

				$(".container").width(1350);
			}
			if ($(window).width()>=1900 && $(window).width()<2100)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1620px",
	    		display: 6
				});	

				$(".container").width(1620);
			}
			if ($(window).width()>=2100 && $(window).width()<2500)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1890px",
	    		display: 7
				});	

				$(".container").width(1890);
			}
			if ($(window).width()>=2500)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "2160px",
	    		display: 8
				});	

				$(".container").width(2160);
			}
	    //$("
	    //$("#jqxgrid").jqxGrid({ height: $(window).height() - 60 });
	    //$(".slider").diyslider("resize", "400px", "200px");
	  @endforeach
	});
</script>