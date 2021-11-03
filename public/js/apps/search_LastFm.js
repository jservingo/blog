// show_app_LastFm.js

var url_api = "LastFm";
var url_search = "/artists/search/";
var custom_type = "Artist";

function search_posts(q, callback)
{
	var posts = new Array();

  url_search = "/artists/search/"+q;
  //alert(url_search);
  fetch(url_search)
  .then((res) => res.json())
  .then(function(rows) {
    rows.forEach(function (row) {
      console.log(row);
      source = row.source ? row.source : "javascript:show_post('"+row.mbid+"')";
      if (row.status_id == 2) {
        excerpt = row.excerpt ? row.excerpt : 'This post has been saved.';
        source_post = '/posts/'+row.post_id;
        source_app = row.source;
      }
      else {
        excerpt = 'This post has not been saved.';
        source_post = "javascript:show_post('"+row.mbid+"')";
        source_app = "javascript:show_post('"+row.mbid+"')";
      }
      /*  
        case 1:
          excerpt = 'This post has been deleted.';
          source_post = "javascript:show_post('"+row.mbid+"')";
          source_app = "javascript:show_post('"+row.mbid+"')";
          break;
      */
  		post = {
  			status_id: row.status_id,
        title: row.name, 
  			excerpt: excerpt, 
  			img: row.url ? row.url : '/img/empty-image.png',
  			source_post: source_post,
        source_app: source_app,
  			custom_type: custom_type,
        footnote: row.footnote ? row.footnote : ' ',
        tags: row.tags ? row.tags : ''
  		};
  		posts.push(post);
  	});
    callback(posts);
	}) 
}

function show_post(mbid)
{
  var myWidth = 1040;
  var myHeight = 560;
  var left = (screen.width - myWidth) / 2;
  var top = (screen.height - myHeight) / 4;
  var myWindow = window.open("/artists/show/"+mbid , 'Edit', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);  
}
