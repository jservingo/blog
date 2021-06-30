<?php 
	use Carbon\Carbon;
	$timestamp_utc = floor(Carbon::now()->timestamp / 60000); 
?>
<script>
	var timestamp_utc = <?php echo $timestamp_utc ?>;
	var timestamp_local = Math.floor(new Date().getTime() / 60000);
	var timezoneOffset = (timestamp_local - timestamp_utc) * 60000;
	console.log(timezoneOffset);

	var d = new Date("2021-06-30 16:17:30 UTC");
    var date = new Date(d.getTime() + timezoneOffset * 60000);
    var fdate = date.toLocaleString('es-ES',{"year":"2-digit","month":"numeric","day":"numeric"});
    console.log(fdate); 
</script>