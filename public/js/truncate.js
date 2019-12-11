/**
 * Truncates the text of an element depending its height.
 *
 * @param {Element} element
 * @param {Number} height
 */
function truncateByHeight(element, sel, height) {
	if (element.clientHeight > height)
	{
		el = element.querySelector(sel);
		if (el !== null)
		{
			var parts = el.innerHTML.split(' ');
			while (parts.length > 0 && element.clientHeight > height + 20)
			{
	  		parts.pop(); 
	    	el.innerHTML = parts.join(' ');
	    	el.innerHTML = el.innerHTML + " ...";
	  	}
  	} 
  }
}

function truncate()
{
	var elements = document.getElementsByClassName("truncate");
	for (var i = 0; i < elements.length; i++) {
		var element = elements[i]; 
		var height = parseInt(element.getAttribute('data-height'));		
		if (element.hasAttribute("data-adjust")) 
			var adjust = element.getAttribute('adjust');
		else 
			var adjust = "true";     
  	truncateByHeight(element, ".t-excerpt", height);
  	truncateByHeight(element, ".t-title", height);
  	truncateByHeight(element, ".t-footnote", height);
  	truncateByHeight(element, ".t-tags", height);
  	if (adjust=="true")
  		element.style.height = ((height) + "px");
	}
}

$(function() {
		truncate();
});

	