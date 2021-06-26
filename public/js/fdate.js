function fdate()
{
	var elements = document.getElementsByClassName("fdate");
	for (var i = 0; i < elements.length; i++) {
		var element = elements[i]; 
		var d = element.textContent;
		var date = new Date(d);
		var fdate = fdateLocal(date);
		element.textContent = fdate;
	}
}

$(function() {
	fdate();
});