// show_app_TVmaze.js

var url_search = "/artists/search/";
var custom_type = "Artist";

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

  alert(q);
  fetch(url_search+q)
  .then((res) => res.json())
  .then(function(rows) {
    console.log(rows);
    rows.forEach(function (row) {
      console.log(row);
      source = row.source ? row.source : "javascript:show_post('"+row.mbid+"')";
  		post = {
  			title: row.name, 
  			excerpt: row.excerpt ? row.excerpt : 'This post has not been saved.', 
  			img: row.img ? row.img : '/img/empty-image.png',
  			source: source,
  			custom_type: custom_type,
        footnote: row.footnote ? row.footnote : ' ',
        tags: row.tags ? row.tags : ''
  		};
      console.log(post);
  		posts.push(post);
  	});
    callback(posts);
	}) 
}

function show_post(mbid)
{
  var myWidth = screen.width - 100;
  var myHeight = screen.height - 200;
  var left = (screen.width - myWidth) / 2;
  var top = (screen.height - myHeight) / 4;
  var myWindow = window.open("/artists/show/"+mbid , 'Edit', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);  
}
