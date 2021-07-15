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
	    		width: "257px",
	    		display: 1
				});

				$(".posts.container").width(257);			
			}
			if ($(window).width()>=720 && $(window).width()<960)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "514px",
	    		display: 2
				});

				$(".posts.container").width(514);			
			}
			if ($(window).width()>=960 && $(window).width()<1200)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "771px",
	    		display: 3
				});		

				$(".posts.container").width(771);
			}
			if ($(window).width()>=1200 && $(window).width()<1500)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1028px",
	    		display: 4
				});	

				$(".posts.container").width(1028);
			}
			if ($(window).width()>=1500 && $(window).width()<1800)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1285px",
	    		display: 5
				});	

				$(".posts.container").width(1285);
			}
			if ($(window).width()>=1800 && $(window).width()<2100)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1542px",
	    		display: 6
				});	

				$(".posts.container").width(1542);
			}
			if ($(window).width()>=2100 && $(window).width()<2300)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1799px",
	    		display: 7
				});	

				$(".posts.container").width(1799);
			}
			if ($(window).width()>=2300)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "2056px",
	    		display: 8
				});	

				$(".posts.container").width(2056);
			}
	    //$("
	    //$("#jqxgrid").jqxGrid({ height: $(window).height() - 60 });
	    //$(".slider").diyslider("resize", "400px", "200px");
	  @endforeach
	});
</script>