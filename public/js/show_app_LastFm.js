// show_app_TVmaze.js

var url_web = "https://www.tvmaze.com/";
var url_api = "/artists/get/all";
var url_search = "";
var custom_type = "Artist";

function get_posts(callback)
{
  var posts = new Array();

  fetch(url_api)
  .then((res) => res.json())
  .then(function(rows) {
    if (rows)
    {
      rows.forEach(function (row) {
        post = {
          title: row.name, 
          excerpt: row.excerpt, 
          img: '',
          url: row.url,
          href: row.url,  //row._links.self.href
          custom_type: custom_type,
          footnote: 'footnote',
          tags: 'tags'
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

	url_search = '/artists/search/'+q;

  fetch(url_search)
  .then((res) => res.json())
  .then(function(rows) {
    rows.forEach(function (row) {
  		post = {
  			title: row.name, 
  			excerpt: row.excerpt ? row.excerpt : '', 
  			img: '',
  			url: row.url,
  			href: row.url,  //row._links.self.href
  			custom_type: custom_type
  		};
  		posts.push(post);
  	});
    console.log(posts);
    callback(posts);
	}) 
}


