$('.searchButton').on('click', function () {
  q = $('.searchTerm').val().trim();
  if(!q.length)
  {
    $.growl.warning({ message: search_empty });
  }
  else
  {         
    location.assign(url_current+'?title='+q);       
  }
});