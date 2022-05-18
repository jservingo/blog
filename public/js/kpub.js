var kpub_page = 0;

function show_kpub(page)
{
	console.log("show page "+page);
	element = $(".kpub[data-page='"+page+"']");
	if (element.length==1 && (kpub_page != page))
	{
		if (kpub_page>=1)
		{
			var old_element = $(".kpub[data-page='"+kpub_page+"']");
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

document.addEventListener("DOMContentLoaded",
 	function() {
		var div, n,
		v = document.getElementsByClassName("youtube-player");
		for (n = 0; n < v.length; n++) {
		 	div = document.createElement("div");
		 	div.setAttribute("data-id", v[n].dataset.id);
			div.innerHTML = labnolThumb(v[n].dataset.id);
			div.onclick = labnolIframe;
			v[n].appendChild(div);
		}
 	});
 
function labnolThumb(id) {
	var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
	play = '<div class="play"></div>';
	return thumb.replace("ID", id) + play;
}
 
function labnolIframe() {
	var iframe = document.createElement("iframe");
	var embed = "https://www.youtube.com/embed/ID?autoplay=1";
	iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
	iframe.setAttribute("frameborder", "0");
	iframe.setAttribute("allowfullscreen", "1");
	this.parentNode.replaceChild(iframe, this);
}