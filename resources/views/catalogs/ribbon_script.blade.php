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
	  	  height: "320px", // height of the slider
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
	    		width: "300px",
	    		display: 1
				});

				$(".container").width(300);			
			}
			if ($(window).width()>=768 && $(window).width()<992)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "540px",
	    		display: 2
				});

				$(".container").width(540);			
			}
			if ($(window).width()>=992 && $(window).width()<1200)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "800px",
	    		display: 3
				});		

				$(".container").width(800);
			}
			if ($(window).width()>=1200)
			{
				$("#slider{{ $i }}").diyslider("updateOptions", {
	    		width: "1040px",
	    		display: 4
				});	
						
				$(".container").width(1040);
			}
	    //$("#jqxgrid").jqxGrid({ height: $(window).height() - 60 });
	    //$(".slider").diyslider("resize", "400px", "200px");
	  @endforeach
	});
</script>