// search_app_TVmaze.js

var app_id = 4;
var url_api = "TVmaze";
var custom_type = "TV Show";

function search_posts(q, callback)
{
	var posts = new Array();

  url_search = "http://api.tvmaze.com/search/shows?q="+q;
  fetch(url_search)
  .then((res) => res.json())
  .then(function(res) {
    var rows = res.map(function (el) {
      return el.show;
    });
    rows.forEach(function (row) {
      genres = row.genres;
      tags = "TVshow";
      for (i=0; i < genres.length; i++) {
        tags += "," + genres[i];
      }
      footnote = "";
      if (row.network)
        footnote = row.network.name + " ";
      if (row.status)
        footnote = row.status;
  		post = {
  			id: 0,
        title: row.name, 
  			excerpt: row.summary, 
  			footnote: footnote,
        img: row.image ? row.image.medium : '',
        source: row.source,
  			custom_type: custom_type,
        tags: tags
  		};
  		posts.push(post);
  	});
    callback(posts);
	}) 
}
