var kpub_page = 0;

function show_kpub(page)
{
	element = $(".kpub[page="+page+"]");
	if (element && (kpub_page != page))
	{
		var old_element = $(".kpub[page="+kpup_page+"]");
		if (old_element)
			old_element.hide();
		element.show();
		kpub_page = page;		
	}
}

function btn_kpub_prev() {
	if (kpub_page > 1)
		show_kpub(kpub_page-1);
}


function btn_kpup_next() {
	show_kpub(kpub_page+1);
}

$(function() {
	show_kpub(1);
});