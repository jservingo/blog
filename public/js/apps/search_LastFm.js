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
          title: row.title, 
          excerpt: row.excerpt, 
          body: row.body,
          footnote: row.footnote,
          links: row.links,
          type_id: 8,
          img: row.img,
          tags: row.tags,
          custom_type: row.custom_type,
          app_id: row.app_id,
          source: row.source,
          published_at: row.published_at        
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
