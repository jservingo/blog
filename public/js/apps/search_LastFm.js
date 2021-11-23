// search_LastFm.js

var custom_type = "Artist";

function search_posts(q, callback)
{
  var posts = new Array();

  url_search = "app/search/posts/"+$app_id+"/"+q;
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
  			img: row.image ? row.image.medium : '',
  			source: row.url,
  			custom_type: custom_type,
        footnote: footnote,
        tags: tags
  		};
  		posts.push(post);
  	});
    callback(posts);
	}) 
}