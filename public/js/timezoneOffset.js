function get_timezoneOffset()
{
	//var date_utc = new Date("2021-06-30 16:17:30 UTC");
	var date_utc = new Date(Date.UTC(2021, 6, 30, 16, 17, 30));
	var timestamp_utc = Math.floor(date_utc.getTime() / 1000);
	console.log(timestamp_utc);
	var date_local = new Date("2021-06-30 16:17:30");
	var timestamp_local = Math.floor(date_local.getTime() / 1000);
	console.log(timestamp_local);
	var timezoneOffset = timestamp_local - timestamp_utc;
	console.log(timezoneOffset);
	return timezoneOffset;
}

var timezoneOffset = get_timezoneOffset();
