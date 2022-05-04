var kpub_page = 0;

function show_kpub(page)
{
	console.log("show page "+page);
	element = $(".kpub[page="+page+"]");
	if (element && (kpub_page != page))
	{
		if (kpub_page>=1)
		{
			var old_element = $(".kpub[page="+kpub_page+"]");
			old_element.hide();
		}
		element.show();
		console.log(element);
		kpub_page = page;		
	}
}

function btn_kpub_prev() {
	if (kpub_page > 1)
		show_kpub(kpub_page-1);
}


function btn_kpub_next() {
	console.log("next");
	show_kpub(kpub_page+1);
}

$(function() {
	console.log("page=1");
	show_kpub(1);
});