<?php 
	use Carbon\Carbon;
	$timestamp_utc = floor(Carbon::now()->timestamp / 60000); 
?>
<script>
	var timestamp_utc = <?php echo $timestamp_utc ?>;
	var timestamp_local = Math.floor(Date.now() / 60000);
	var timezoneOffset = (timestamp_utc - timestamp_local) * 60000;
	console.log(timezoneOffset);
</script>