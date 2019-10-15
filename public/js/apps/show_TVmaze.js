// show_app_TVmaze.js

var url_search = "http://api.tvmaze.com/search/shows?q=";
var custom_type = "TV Show";

function get_posts(callback)
{
  var posts = new Array();

  fetch('/app/get/posts/'+app_id)
  .then((res) => res.json())
  .then(function(rows) {
    if (rows)
    {
      rows.forEach(function (row) {
        tags_str = "";
        tags = row.tags;
        for (i=0; i < tags.length; i++) {
          tags_str += "," + tags[i].name;
        }        
        post = {
          title: row.title, 
          excerpt: row.excerpt, 
          img: row.photos.length > 0 ? row.photos[0].url : '',
          source: row.source,
          custom_type: row.custom_type,
          footnote: row.footnote,
          tags: tags_str
        };
        posts.push(post);
      });    
      callback(posts);  
    }
  })
  .catch((error) => console.log(error))  
}	

function search_posts(q, callback)
{
	var posts = new Array();

  fetch(url_search+q)
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
        footnote += row.status;
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
