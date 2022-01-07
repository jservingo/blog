{{-- home.color_picker --}} 

@extends('layout')

@section('content')

@php
	$bgcolor = "#F7FAFD";
	$txcolor = "#f000";
@endphp

<div id="dual1" style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:10px;padding-left:30px;padding-bottom:0px">
	<h3>Color set 1</h3>
	<div id="da1" style="width:840px;width:50px;height:50px;float:left;background-color:#d7e9f3;color:white;margin:10px;">&nbsp;</div>
	<div id="da2" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da3" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da4" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da5" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da6" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da7" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da8" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da9" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da10" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da11" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da12" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="da13" class="da" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>

<div style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:0px;padding-left:30px;">
	<div id="da1_t" style="width:840px;width:50px;height:10px;float:left;margin-left:10px;">&nbsp;</div>
	<div id="da2_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da3_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da4_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da5_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da6_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da7_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da8_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da9_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da10_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da11_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da12_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="da13_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>

<div id="dual2" style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:10px;padding-left:30px;">
	<h3>Color set 2</h3>
	<div id="db1" style="width:50px;height:50px;float:left;background-color:#fff;color:white;margin:10px;">&nbsp;</div>
	<div id="db2" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db3" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db4" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db5" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db6" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db7" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db8" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db9" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db10" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db11" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db12" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="db13" class="db" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>

<div style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:0px;padding-left:30px;">
	<div id="db1_t" style="width:840px;width:50px;height:10px;float:left;margin-left:10px;">&nbsp;</div>
	<div id="db2_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db3_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db4_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db5_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db6_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db7_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db8_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db9_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db10_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db11_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db12_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="db13_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>

<div id="blender" style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:10px;padding-left:30px;">
	<h3>Blender</h3>
	<div id="b1" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b2" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b3" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b4" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b5" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b6" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b7" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b8" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b9" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b10" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b11" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b12" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="b13" class="bl" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>

<div style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:0px;padding-left:30px;">
	<div id="b1_t" style="width:840px;width:50px;height:10px;float:left;margin-left:10px;">&nbsp;</div>
	<div id="b2_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b3_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b4_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b5_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b6_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b7_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b8_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b9_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b10_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b11_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b12_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div id="b13_t" class="da" style="width:50px;height:10px;float:left;margin-left:20px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>

<div id="selected1" style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:10px;padding-left:30px;">
	<h3>Selected colors set 1</h3>
	<div id="sa1" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa2" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa3" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa4" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa5" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa6" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa7" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa8" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa9" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa10" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa11" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa12" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sa13" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>

<div id="selected1" style="width:910px;margin:auto;background-color:#F7FAFD;padding-top:10px;padding-left:30px;padding-bottom:30px;">
	<h3>Selected colors set 2</h3>
	<div id="sb1" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb2" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb3" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb4" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb5" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb6" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb7" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb8" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb9" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb10" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb11" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb12" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div id="sb13" style="width:50px;height:50px;float:left;background-color:black;margin:10px;">&nbsp;</div>
	<div style="clear: both"></div> 
</div>
@endsection

@push('styles')
	<style>
		h3 {margin: 5px;}
	</style>
  <link rel="stylesheet" href="/css/framework.css">
  <!--<link rel="stylesheet" href="/css/multiselect.css">-->
@endpush

@push('scripts')
  <script type="text/javascript" src="/js/jquery.confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/jquery.growl.js"></script>
  <script type="text/javascript" src="/js/jquery.buttons/header.js"></script>
  <!--<script type="text/javascript" src="/js/jquery.multiselect.js"></script>-->
  <script type="text/javascript" src="/js/popr.js"></script>
  <script>
    $(document).ready(function() {
     $('.popr').popr();
    });

    function componentToHex(c) {
    	var hex = c.toString(16);
    	return hex.length == 1 ? "0" + hex : hex;
		}

		function rgbToHex(r, g, b) {
    	return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
		}

    $("#da1").click(function() {
    	selected = "da";
    	$('#da1').text('**Sel**');
    	$('#db1').text('');
    });

    $("#db1").click(function() {
    	selected = "db";
    	$('#da1').text('');
    	$('#db1').text('**Sel**');
    });

    $("#dual1").on("click", ".da", function() {
    	s = $(this).css("background-color");
    	r = get_color(s,"red");
    	g = get_color(s,"green");
    	b = get_color(s,"blue");
    	da1_red = r;
    	da1_green = g;
    	da1_blue = b;
    	rgb = "rgb("+r+","+g+","+b+")";
    	$("#da1").css('background-color',rgb);
    	$("#da1_t").text(rgbToHex(r,g,b));
    	refresh_da();
    	blender();
		});

		$("#dual2").on("click", ".db", function() {
    	s = $(this).css("background-color");
    	r = get_color(s,"red");
    	g = get_color(s,"green");
    	b = get_color(s,"blue");
    	db1_red = r;
    	db1_green = g;
    	db1_blue = b;
    	rgb = "rgb("+r+","+g+","+b+")";
    	$("#db1").css('background-color',rgb);
    	$("#db1_t").text(rgbToHex(r,g,b));
    	refresh_db();
    	blender();
		});

		$("#blender").on("click", ".bl", function() {
    	s = $(this).css("background-color");
    	r = get_color(s,"red");
    	g = get_color(s,"green");
    	b = get_color(s,"blue");
    	rgb = "rgb("+r+","+g+","+b+")";
    	if(selected=="da")
    	{
    		da1_red = r;
    		da1_green = g;
    		da1_blue = b;
    		$("#da1").css('background-color',rgb);
    		$("#da1_t").text(rgbToHex(r,g,b));
    		refresh_da();
    		blender();
    	}
    	else
    	{
    		db1_red = r;
    		db1_green = g;
    		db1_blue = b;
				$("#db1").css('background-color',rgb);
    		$("#db1_t").text(rgbToHex(r,g,b));
    		refresh_db();
    		blender();    		
    	}
		});

    var da1 = $("#da1").css("background-color");
    var da1_red = get_color(da1,"red");
    var da1_green = get_color(da1,"green");
    var da1_blue = get_color(da1,"blue");

    var db1 = $("#db1").css("background-color");
    var db1_red = get_color(db1,"red");
    var db1_green = get_color(db1,"green");
    var db1_blue = get_color(db1,"blue");

    var selected = "da";

    function gen_color(e,r,g,b)
    {
    	if (r > 255)
    		r = r - 256;
    	if (g > 255)
    		g = g - 256;
    	if (b > 255)
    		b = b - 256;
    	rgb = "rgb("+r+","+g+","+b+")";
    	$("#"+e).css('background-color',rgb);
    	$("#"+e+"_t").text(rgbToHex(r,g,b));
    }

    function get_color(s,color)
    {
    	colorsOnly = s.substring(s.indexOf('(') + 1, s.lastIndexOf(')')).split(/,\s*/),
    	red = colorsOnly[0],
    	green = colorsOnly[1],
    	blue = colorsOnly[2];
    	if (color=="red")
    		return parseInt(red);
    	if (color=="green")
    		return parseInt(green);
    	if (color=="blue")
    		return parseInt(blue);
    }

    function blender()
    {
    	inc_red = (db1_red - da1_red) / 12;
    	inc_green = (db1_green - da1_green) / 12;
    	inc_blue = (db1_blue - da1_blue) / 12;

    	r0 = da1_red;
    	g0 = da1_green;
    	b0 = da1_blue;

    	rgb = "rgb("+r0+","+g0+","+b0+")";
    	$("#b1").css('background-color',rgb);

    	for (i=1;i<=15;i++)
    	{
    		j=i+1;
    		r = Math.floor(r0 + (inc_red * i));
    		g = Math.floor(g0 + (inc_green * i));
    		b = Math.floor(b0 + (inc_blue * i));

    		rgb = "rgb("+r+","+g+","+b+")";
	    	$("#b"+j).css('background-color',rgb);
	    	$("#b"+j+"_t").text(rgbToHex(r,g,b));
	    }
    }

    function refresh_da()
    {
    	/* Degradado red */
    	r0 = da1_red+64;
    	if (r0>255) 
    		r0 = r0-256;
    	g0 = da1_green;
    	b0 = da1_blue;

    	inc_red = (255 - da1_red) / 4;
    	inc_green = (255 - g0) / 4;
    	inc_blue = (255 - b0) / 4;

    	for (i=1;i<=4;i++)
    	{
    		j=i+1;
    		r = Math.floor(r0 + (inc_red * i));
    		g = Math.floor(g0 + (inc_green * i));
    		b = Math.floor(b0 + (inc_blue * i));

    		rgb = "rgb("+r+","+g+","+b+")";
	    	$("#da"+j).css('background-color',rgb);
	    	$("#da"+j+"_t").text(rgbToHex(r,g,b));
	    }

	    /* Degradado green */
	    r0 = da1_red;
    	g0 = da1_green+64;
    	if (g0>255)
    		g0 = g0-256;
    	b0 = da1_blue;

	    inc_red = (255 - r0) / 4;
    	inc_green = (255 - da1_green) / 4;
    	inc_blue = (255 - b0) / 4;

    	for (i=1;i<=4;i++)
    	{
    		j=i+5;
    		r = Math.floor(r0 + (inc_red * i));
    		g = Math.floor(g0 + (inc_green * i));
    		b = Math.floor(b0 + (inc_blue * i));

    		rgb = "rgb("+r+","+g+","+b+")";
	    	$("#da"+j).css('background-color',rgb);
	    	$("#da"+j+"_t").text(rgbToHex(r,g,b));
	    }

	    /* Degradado blue */
	    r0 = da1_red;
    	g0 = da1_green;
    	b0 = da1_blue+64;
    	if (b0>255)
    		b0 = b0-256;

	    inc_red = (255 - r0) / 4;
    	inc_green = (255 - g0) / 4;
    	inc_blue = (255 - da1_blue) / 4;

    	for (i=1;i<=4;i++)
    	{
    		j=i+9;
    		r = Math.floor(r0 + (inc_red * i));
    		g = Math.floor(g0 + (inc_green * i));
    		b = Math.floor(b0 + (inc_blue * i));

    		rgb = "rgb("+r+","+g+","+b+")";
	    	$("#da"+j).css('background-color',rgb);
	    	$("#da"+j+"_t").text(rgbToHex(r,g,b));
	    }
    }

    function refresh_db()
    {
    	/* Degradbdo red */
    	r0 = db1_red+64;
    	if (r0>255) 
    		r0 = r0-256;
    	g0 = db1_green;
    	b0 = db1_blue;

    	inc_red = (255 - db1_red) / 4;
    	inc_green = (255 - g0) / 4;
    	inc_blue = (255 - b0) / 4;

    	for (i=1;i<=4;i++)
    	{
    		j=i+1;
    		r = Math.floor(r0 + (inc_red * i));
    		g = Math.floor(g0 + (inc_green * i));
    		b = Math.floor(b0 + (inc_blue * i));

    		rgb = "rgb("+r+","+g+","+b+")";
	    	$("#db"+j).css('background-color',rgb);
	    	$("#db"+j+"_t").text(rgbToHex(r,g,b));
	    }

	    /* Degradbdo green */
	    r0 = db1_red;
    	g0 = db1_green+64;
    	if (g0>255)
    		g0 = g0-256;
    	b0 = db1_blue;

	    inc_red = (255 - r0) / 4;
    	inc_green = (255 - db1_green) / 4;
    	inc_blue = (255 - b0) / 4;

    	for (i=1;i<=4;i++)
    	{
    		j=i+5;
    		r = Math.floor(r0 + (inc_red * i));
    		g = Math.floor(g0 + (inc_green * i));
    		b = Math.floor(b0 + (inc_blue * i));

    		rgb = "rgb("+r+","+g+","+b+")";
	    	$("#db"+j).css('background-color',rgb);
	    	$("#db"+j+"_t").text(rgbToHex(r,g,b));
	    }

	    /* Degradbdo blue */
	    r0 = db1_red;
    	g0 = db1_green;
    	b0 = db1_blue+64;
    	if (b0>255)
    		b0 = b0-256;

	    inc_red = (255 - r0) / 4;
    	inc_green = (255 - g0) / 4;
    	inc_blue = (255 - db1_blue) / 4;

    	for (i=1;i<=4;i++)
    	{
    		j=i+9;
    		r = Math.floor(r0 + (inc_red * i));
    		g = Math.floor(g0 + (inc_green * i));
    		b = Math.floor(b0 + (inc_blue * i));

    		rgb = "rgb("+r+","+g+","+b+")";
	    	$("#db"+j).css('background-color',rgb);
	    	$("#db"+j+"_t").text(rgbToHex(r,g,b));
	    }
	  }

    refresh_da();
    refresh_db();
    blender();
  </script> 
  @include('home.message')
@endpush