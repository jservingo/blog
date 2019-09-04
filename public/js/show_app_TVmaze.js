// show_app_TVmaze.js

var url_web = "https://www.tvmaze.com/";
var url_api = "https://api.tvmaze.com/shows";
var url_search = "";
var custom_type = "TV Show";

function get_posts(callback)
{
  var posts = new Array();

  fetch(url_api)
  .then((res) => res.json())
  .then(function(rows) {
    rows.forEach(function (row) {
      post = {
        title: row.name, 
        excerpt: row.summary, 
        img: row.image ? row.image.medium : '',
        url: row.url,
        href: row._links.self.href,
        custom_type: custom_type,
        footnote: 'footnote',
        tags: 'tags'
      };
      posts.push(post);
    });    
    callback(posts);  
   })
  .catch((error) => console.log(error))  
}	

function search_posts(q, callback)
{
	var posts = new Array();

	url_search = 'http://api.tvmaze.com/search/shows?q='+q;

  fetch(url_search)
  .then((res) => res.json())
  .then(function(res) {
    var rows = res.map(function (el) {
      return el.show;
    });
    rows.forEach(function (row) {
  		post = {
  			title: row.name, 
  			excerpt: row.summary, 
  			img: row.image ? row.image.medium : '',
  			url: row.url,
  			href: row._links.self.href,
  			custom_type: custom_type
  		};
  		posts.push(post);
  	});
    callback(posts);
	}) 
}
