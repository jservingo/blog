// search_LastFm.js

var url_api = "LastFm";
var app_id = 4;
var custom_type = "Artist";

function search_posts(q, callback)
{
  var posts = new Array();

  url_search = "app/search/posts/"+app_id+"/"+q;
  fetch(url_search)
  //.then((res) => res.json())
  .then(function(res) {
    var rows = res.map(function (el) {
      return el.artists;
    });
    rows.forEach(function (row) {
      rtags = row.tags;
      tags = "";
      for (i=0; i < rtags.length; i++) {
        tags += "," + rtags[i];
      }
  		post = {
  			title: row.name, 
  			excerpt: row.summary, 
  			img: row.img,
  			source: row.url,
  			custom_type: row.custom_type,
        footnote: row.footnote,
        tags: row.tags
  		};
  		posts.push(post);
  	});
    callback(posts);
	}) 
}