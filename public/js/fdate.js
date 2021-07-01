function fdate()
{
	var elements = document.getElementsByClassName("fdate");
	for (var i = 0; i < elements.length; i++) {
		var element = elements[i]; 
		var d = element.textContent;
		var date = new Date(d+" UTC");
		var fdate = fdateLocal(date);
		element.textContent = fdate;
	}
}

function fdateTime()
{
	var elements = document.getElementsByClassName("fdateTime");
	for (var i = 0; i < elements.length; i++) {
		var element = elements[i]; 
		var d = element.textContent;
		var date = new Date(d+" UTC");
		var fdate = fdateTimeLocal(date);
		element.textContent = fdate;
	}
}

$(function() {
	fdate();
	fdateTime();
});