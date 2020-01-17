$(function() {
  var $appPostsContainer = $('#posts_container').find('.app-posts');
  var $appPostsMenu = $('#app_posts_menu');

  var template_menu = "";

  /*'<div class="popr-box" data-box-id=":post_id:">'+
    '<div class="popr-item" data-btn="btn_delete_app_post" data-mbid=":mbid:">Copy</div>'+
    '<div class="popr-item" data-btn="btn_copy_post" data-id=":post_id:">Copy</div>'+
    '<div class="popr-item" data-btn="btn_save_app_post" data-id=":app_id:">Save</div>'+
    '</div>';
  */

  var template_post = '<div class="post pfull">'+
    '<div class="content-post" style="background-color:#fefdfd">'+
      '<div style="float:right;">'+
        '<div class="header" style="float:right;">'+
          '<header class="xcontainer-flex xspace-between">'+
          '<div class="date truncate" data-height="51" style="width: 20px; padding: 10px 5px 2px 10px; background-color: rgb(254, 253, 253); height: 51px;">'+
            '<div>'+ 
              '<div class="popr box_popup" style="position:absolute; top:10px; right:5px;" data-id=":post_id:">'+
                '<img src="/img/options.png" width="20">'+
              '</div>'+ 
            '</div>'+ 
            '</div>'+
            '<!-- Nothing -->'+
          '</header>'+
        '</div>'+
        '<div style="float:left;">'+
          '<div class="content" style="width: 578px; background-color: rgb(254, 253, 253); padding: 8px 10px 0px;">'+      
            '<a href=":source:" target="_blank" class="text-uppercase c-blue" data-id=":app_id:">'+
              '<h1 id="t-title" class="t-title" style="margin-top:0;margin-bottom:6px">:title:</h1>'+  
            '</a>'+
          '</div>'+            
        '</div>'+
        '<div style="clear:both;"></div>'+
        '<div>'+
          '<div class="scontent" style="width: 605px; background-color: rgb(254, 253, 253); padding: 2px 10px 10px; text-align: justify;">'+
            '<a href=":source:" id="t-excerpt" target="_blank" class="t-excerpt c-negro" data-id=":app_id:">'+
              ':excerpt:'+
            '</a>'+
          '</div>'+
          '<div class="scontent" style="width: 605px; background-color: rgb(254, 253, 253); padding: 2px 10px 10px; text-align: justify;">'+
            ':links_str:'+
          '</div>'+
        '</div>'+
      '</div>'+
      '<div class="media" style="float:left;">'+
        '<div style="width:345px; height:auto; overflow:auto; background-color:#d7e9f3">'+
        '<img src=":img:" alt=":img alt:" id="t-img" class="img-responsive ifull">'+
        '</div>'+
      '</div>'+
      '<div style="clear:both;"></div>'+      
      '<div>'+
        '<div style="float:right;">'+
          '<div class="truncate" data-height="18" style="width: 210px; background-color: rgb(254, 253, 253); padding: 4px 10px; text-align: right; height: 18px;">'+
            '<span class="user c-blue">'+
              '<a id="t-user" href="\\posts\\:owner_post:">'+
                ':owner_name:'+
              '</a>'+
              '&nbsp;&nbsp;'+
            '</span>'+
            '<span id="t-date" class="c-gray-1" style="">'+
              ':date:'+
            '</span>'+
          '</div>'+ 
        '</div>'+
        '<div style="float:left;">'+               
          '<div class="truncate footnote" data-height="24" data-adjust="false" style="width: 723px; color: rgb(21, 85, 151); font-weight: 800; background-color: rgb(254, 253, 253); padding: 6px 10px;">'+     
            '<div id="t-tags" class="t-tags">'+
              ':tags_str:'+
            '</div>'+ 
          '</div>'+
        '</div>'+
        '<div style="clear:both;"></div>'+
      '</div>'+
      '<div>'+
        '<div style="float:right;">'+
          '<footer class="xcontainer-flex xspace-between" style="width:210px; height:24px; background-color:#fefdfd; padding: 6px 10px; text-align:right;">'+
            '<a class="btn_delete_lastfm_post" '+ 
                  'data-mbid=":mbid:">'+
              '<img src="/img/delete.png" width="24">'+
            '</a>'+           
            '<a class="btn_save_lastfm_post" '+ 
                  'data-id=":app_id:" '+
                  'data-mbid=":mbid:" '+
                  'data-title=":title:" '+
                  'data-excerpt=":excerpt:" '+
                  'data-img=":img:" '+
                  'data-tags=":tags:" '+
                  'data-links=":links:" '+
                  'data-footnote=":footnote:" '+
                  'data-date=":date:" '+
                  'data-user=":owner_name:" '+
                  'data-source=":source:" '+
                  'data-custom_type=":custom_type:">'+
              '<img src="/img/save.png" width="24">'+
            '</a>'+
          '</footer>'+ 
        '</div>'+
        '<div style="float:left;">'+               
          '<div class="truncate footnote" data-height="24" data-adjust="false" style="width: 723px; color: rgb(29, 113, 167); font-weight: 800; background-color: rgb(254, 253, 253); padding: 6px 10px;">'+     
            '<div id="t-footnote" class="t-footnote">'+
              ':footnote:'+
            '</div>'+
          '</div>'+
        '</div>'+
        '<div style="clear:both;"></div>'+
      '</div>'+
    '</div>'+
    '</div>';

	var api_key = "8fcc4758809b19662cdb6fab49ff689b";
	var url = 'http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&mbid='+mbid+'&api_key='+api_key+'&format=json';
  //console.log(url);
  fetch(url)
	.then((res) => res.json())
	.then(function(row) {
		var post = row.artist;
    if (post)
    {
      var f = new Date();
      var date = f.getDate() + ' ' + get_month(f) + ' ' + f.getFullYear();
      var img = "/img/music.png";
      var links = "";
      var links_str = "";
      var tags = "Music";
      if (post.tags)
      {
        for (i=0; i < post.tags.tag.length; i++) {
          tags += "," + post.tags.tag[i].name;
        }
      }
      //console.log('Tags: '+tags);
      var url = "http://musicbrainz.org/ws/2/artist/"+mbid+"?inc=url-rels&fmt=json"; 
      //console.log(url);
      fetch(url)
      .then((res) => res.json())
      .then(function(row) {   
        //console.log("Parsing relations");   
        for (i=0; i < row.relations.length; i++) {
          links = links + row.relations[i]['type'] + "~" + row.relations[i]['url']['resource'] + "|";
          if (row.relations[i]['type'] == 'image')
            url_image = row.relations[i]['url']['resource'];
        }
        links_str = renderLinks(links);
        //console.log('Links: '+links_str);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var data = {url_image: url_image};
        $.ajax({
          type: 'post',
          url: '/artists/get/image',
          data: data,
          dataType: 'json',
          success: function(img) {
            //console.log('Image: '+img);
            renderPost(post,date,tags,links,links_str,img);
          }
        });
      })
      .catch(function(error) {
        renderPost(post,date,tags,links,img);
      });
    }
    else
    {
      var post_new = '<h2>Sorry!!! The artist was not found in the database</h2>'+
        '<p>Please delete this record &nbsp; &nbsp; &nbsp;'+
        '<a class="btn_delete_lastfm_post" '+ 
          'data-mbid="'+ mbid + '">'+
          '<img src="/img/delete.png" width="24">'+
        '</a></p>';
      var $post_new = $(post_new);
      $appPostsContainer.append($post_new.fadeIn(1500));
    }
	}); 

  function renderPost(post, date, tags, links, links_str, img)
  {
    var post_new = template_post
      .replace(/:title:/g, post.name)
      .replace(/:mbid:/g, mbid)
      .replace(/:img:/g, img)
      .replace(/:excerpt:/g, post.bio.summary.replace(/['"]+/g, '').replace(/<[^>]+>/g, ''))
      .replace(/:links:/g, links_str)
      .replace(/:links_str:/g, links_str)
      .replace(/:tags:/g, tags)
      .replace(/:tags_str:/g, renderTags(tags))
      .replace('Read more on Last.fm', '')
      .replace(/:footnote:/g, ' ')
      .replace(/:source:/g, post.url)
      .replace(/:img alt:/g, post.name + " Logo")
      .replace(/:app_id:/g, 4)
      .replace(/:post_id:/g, 1)
      .replace(/:owner_name:/g, 'LastFm')
      .replace(/:owner_post:/g, 132)
      .replace(/:date:/g, date)
      .replace(/:custom_type:/g, "Artist")

    var post_menu = template_menu
      .replace(/:post_id:/g, 1)
      .replace(/:app_id:/g, 4)
      .replace(/:custom_type:/g, "Artist")

    var $post_new = $(post_new);
    var $post_menu = $(post_menu);

    $appPostsContainer.append($post_new.fadeIn(1500));
    $appPostsMenu.append($post_menu);

    $('.popr').popr();
  }


  function renderTags(tags)
  {
    var tags_str = "";
    var tags = tags.split(",");
    for (i=0; i < tags.length; i++)
    {
      tags_str = tags_str + "#" + tags[i] + " ";  
    } 
    return tags_str; 
  }

  function renderLinks(links)
  {
    var links_spl = links.split("|");
    var links_str = "";
    for (i=0; i < links_spl.length; i++)
    {
      var parts = links_spl[i].split("~");
      links_str = links_str + "<a href='" + parts[1] + "' target='_blank'>" + parts[0] + "</a> ";  
    } 
    return links_str; 
  }

  function get_month(f)
  {
    var meses = new Array ("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    return (meses[f.getMonth()]);  
  }

  //Event Delegation
  $('.app-posts').on("click",".btn_delete_lastfm_post", function(e){
    var mbid = $(this).data("mbid");
    btn_delete_lastfm_post(mbid);
  });

  //Event Delegation
  $('.app-posts').on("click",".btn_save_lastfm_post", function(e){
    var app_id = $(this).data("id");
    var mbid = $(this).data("mbid");
    var title = $(this).data("title");
    var excerpt = $(this).data("excerpt");
    var img = $(this).data("img");
    var tags = $(this).data("tags");
    var links = $(this).data("links");
    var footnote = $(this).data("footnote");
    var date = $(this).data("date");
    var user = $(this).data("user");
    var source = $(this).data("source");
    var custom_type = $(this).data("custom_type");
    btn_save_lastfm_post(app_id, mbid, title, excerpt, img, tags, links, footnote, date, user, source, custom_type); 
  }); 

  function btn_save_lastfm_post(app_id, mbid, title, excerpt, img, tags, links, footnote, date, user, source, custom_type)
  {
    $.createDialog({
      attachAfter: '#main_panel',
      title: 'Are you sure you want to save this post?',
      accept: 'Si',
      refuse: 'No',
      acceptStyle: 'red',
      refuseStyle: 'gray',
      acceptAction: function(){
        save_app_post(app_id, title, excerpt, img, tags, links, footnote, date, user, source, custom_type, function(data){
          save_lastfm_post(mbid, data.post_id);
        });
      }
    });
    $.showDialog();  
  }

  function btn_delete_lastfm_post(mbid)
  {
    $.createDialog({
      attachAfter: '#main_panel',
      title: 'Are you sure you want to delete this post?',
      accept: 'Si',
      refuse: 'No',
      acceptStyle: 'red',
      refuseStyle: 'gray',
      acceptAction: function(){
        delete_lastfm_post(mbid);
      }
    });
    $.showDialog();  
  } 

  function save_lastfm_post(mbid, post_id)
  {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var data = { mbid: mbid, post_id: post_id };
    $.ajax({
      type: 'post',
      url: '/artists/save',
      data: data,
      dataType: 'json',
      success: function(data) {
        if (data.success){        
          set_message("notice","Te post was saved.");
          location.reload();
        }
        else if(data.msg)
        {
          $.growl.warning({ message:data.msg });
        }
        else {
          set_message("error","Sorry but the post was not saved. Try again, please.");
          location.reload();
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    }); 
  } 

  function delete_lastfm_post(mbid)
  {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'delete',
      url: '/artists/'+mbid,
      dataType: 'json',
      success: function(data) {
        if (data.success){
          $.growl.notice({ message:"The post was deleted." });
          //window.close();
        }
        else if(data.msg)
        {
          $.growl.warning({ message:data.msg });
        }
        else {
          set_message("error","Sorry but the post was not deleted. Try again, please.");
          location.reload();
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    }); 
  }
});