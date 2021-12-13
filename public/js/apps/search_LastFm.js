// search_LastFm.js

var url_api = "LastFm";
var app_id = 4;

function search_posts(q, callback)
{
  var posts = new Array();

  url_search = "/app/search/posts/"+app_id+"/"+q;

  $.ajax({
    url: url_search,
    dataType: 'json',
    success: function(data) {
      data.rows.forEach(function (row) {
        rtags = row.tags.split(",");
        tags = "";
        for (i=0; i < rtags.length; i++) {
          if (tags=="")
            tags += rtags[i];
          else
            tags += "," + rtags[i];
        }
        post = {
          id: 0,
          title: row.title, 
          excerpt: row.excerpt, 
          footnote: row.footnote,
          img: row.img,
          source_app: row.source,
          source_post: '/posts/'+row.id,
          custom_type: row.custom_type,
          tags: row.tags          
        };
        posts.push(post);        
      }); 
      callback(posts);   
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
