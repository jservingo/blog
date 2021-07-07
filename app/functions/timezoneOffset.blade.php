<?php 
	use Illuminate\Support\Facades\DB;
	use Carbon\Carbon;

	$result = DB::select( 'select NOW() as the_time' );
    $date->$result[0]->the_time; 
    $timestamp_utc = Carbon::parse($date)->timestamp;
?>
<script>
	var timestamp_utc = <?= $timestamp_utc ?>;
	console.log(timestamp_utc);
	var timestamp_local = Math.floor(new Date(Date.now()).getTime()/1000);
	console.log(timestamp_local);
	var timezoneOffset = timestamp_local - timestamp_utc;
	console.log(timezoneOffset);

	/*
	var d = new Date("2021-06-30 16:17:30 UTC");
	var timestamp = Math.floor(d.getTime());
	console.log(timestamp);
    var date = new Date(timestamp + timezoneOffset * 1000);
    var fdate = date.toLocaleString('es-ES', {'year':'numeric', 'month':'2-digit', 'day':'2-digit', 'hour':'2-digit', 'minute':'2-digit', 'second':'2-digit' });
    console.log(fdate);
    */ 
</script>