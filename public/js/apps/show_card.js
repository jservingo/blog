$(function() {
  //var $appPostsContainer = $('#app-body').find('.tv-shows');
  var $appPostsContainer = $('#posts_container').find('.app-posts');
  var $appPostsMenu = $('#app_posts_menu');
  var $pagination = $('#pagination');
  var $loader = "<div class='loader'></div>";
  var per_page= 12;

  /*
  $('#light-pagination').pagination({
    itemsOnPage: 10,
    cssStyle: 'light-theme',
    onPageClick(pageNumber, event){
      //$appPostsContainer.find('.app-loader').remove();
      var posts = JSON.parse(localStorage.app_posts);
      var num = posts.length;
      var visible_posts = slicePosts(posts,num,page);
      renderPosts(visible_posts);      
    }
  });
  */

  var template_menu = '<div class="popr-box" data-box-id=":post_id:">'+
    '<div class="popr-item" data-btn="btn_copy_post" data-id=":post_id:">Copy</div>'+
    '<div class="popr-item" data-btn="btn_save_app_post" data-id=":app_id:">Save</div>'+
    '</div>';

  var template_post = '<div class="post pcard">'+
   '<div class="content-post">'+
    '<div style="float:right;">'+
      '<header class="xcontainer-flex xspace-between">'+
        '<div class="date truncate" data-height="51" style="width: 226px; padding: 10px 5px 5px 10px; background-color: rgb(215, 233, 243);">'+
          '<a href=":source_post:" class="text-uppercase c-blue" data-id="1">'+
            '<h1 class="t-title" style="margin-top:0;margin-bottom:0px;margin-right:22px;">:title:</h1>'+  
          '</a>'+   
          '<div>'+ 
           '<div class="popr box_popup" style="position:absolute; top:10px; right:5px;" data-id=":post_id:">'+
             '<img src="/img/options.png" width="20">'+
           '</div>'+ 
          '</div>'+ 
        '</div>'+ 
        '<div class="post-category">'+
          '<span class="category dark-wine text-capitalize">'+
            '<a href=":source_app:" target="_blank">'+
              ':custom_type:'+
            '</a>'+
          '</span>'+
        '</div>'+ 
      '</header>'+
    '</div>'+
    '<div style="float:left;">'+
      '<div style="height:66px; background-color:#d7e9f3">'+
       '<img src=":img:" alt=":img alt:" class="img-responsive icard" width="66">'+
      '</div>'+
    '</div>'+ 
    '<div style="clear:both;"></div>'+        
    '<div>'+
      '<div class="truncate" data-height="128" style="width: 287px; background-color: rgb(254, 253, 253); padding: 10px 10px 4px; text-align: justify;">'+
        '<a href=":source_post:" class="t-excerpt c-negro" data-id="1">'+
          ':excerpt:'+
        '</a>'+        
      '</div>'+
    '</div>'+ 
    '<div>'+
      '<div class="truncate" data-height="18" style="width: 287px; background-color: rgb(254, 253, 253); padding: 4px 10px; text-align: right; height: 18px;">'+
        '<span class="user c-blue">'+
          '<a href="\\posts\\:owner_post:">'+
            ':owner_name:'+
          '</a>'+
          '&nbsp;&nbsp;'+
        '</span>'+
        '<span class="c-gray-1" style="">'+
          '19 Jan 2019'+
        '</span>'+
      '</div>'+
      '<footer class="xcontainer-flex xspace-between" style="width:287px; height:24px; background-color:#d7e9f3; padding: 6px 10px; text-align:right;">'+
            '<a class="btn_copy_app_post" '+ 
                'data-id=":app_id:" '+
                'data-title=":title:" '+
                'data-source=":source_app:">'+
              '<img src="/img/copy.png" width="24">'+
            '</a>'+
            '<a class="btn_save_app_post" '+ 
                  'data-id=":app_id:" '+
                  'data-title=":title:" '+
                  'data-excerpt=":excerpt:" '+
                  'data-img=":img:" '+
                  'data-tags=":tags:" '+
                  'data-links="" '+
                  'data-footnote=":footnote:" '+
                  'data-date=":date:" '+
                  'data-user=":owner_name:" '+
                  'data-source=":source_app:" '+
                  'data-custom_type=":custom_type:">'+
              '<img src="/img/save.png" width="24">'+
            '</a>'+
      '</footer>'+
    '</div>'+  
  '</div>'+
  '</div>'; 

  function slicePosts(posts,num,page)
  {
    var pi = (page-1)*per_page;
    var pf = pi+per_page; 
    if (pf > num)
      pf = num;
    return (posts.slice(pi,pf));
  }      

  function renderPosts(visible_posts) {
    //render posts
    $appPostsContainer.empty();
    $appPostsMenu.empty();

    visible_posts.forEach(function (post) {
      renderPost(post,0);
    });

    $('.popr').popr();
  }

  function renderPost(post, post_id)
  {
    var f = new Date();
    var date = f.getDate() + ' ' + get_month(f) + ' ' + f.getFullYear();
    var post_new = template_post
      .replace(/:title:/g, post.title)
      .replace(/:img:/g, post.img)
      .replace(/:excerpt:/g, post.excerpt.replace(/['"]+/g, '').replace(/<[^>]+>/g, ''))
      .replace(/:tags:/g, post.tags)
      .replace(/:footnote:/g, post.footnote)
      .replace(/:source_app:/g, post.source_app)
      .replace(/:source_post:/g, post.source_post)
      .replace(/:img alt:/g, post.title + " Logo")
      .replace(/:app_id:/g, app_id)
      .replace(/:post_id:/g, post_id)
      .replace(/:owner_name:/g, owner_name)
      .replace(/:owner_post:/g, owner_post)
      .replace(/:date:/g, date)
      .replace(/:custom_type:/g, post.custom_type)

    var post_menu = template_menu
      .replace(/:post_id:/g, post_id)
      .replace(/:custom_type:/g, post.custom_type)

    var $post_new = $(post_new);
    var $post_menu = $(post_menu);

    $appPostsContainer.append($post_new); //.fadeIn(1500)
    $appPostsMenu.append($post_menu);
  }   

  function renderPagination(num)
  {
    if (num > per_page)
    {
      //var totalPages = Math.ceil(num / per_page);
      $('#light-pagination').pagination({
        items: num,
        itemsOnPage: per_page,        
        cssStyle: 'light-theme',
        onPageClick(page, event){
          //$appPostsContainer.find('.app-loader').remove();
          var posts = JSON.parse(localStorage.app_posts);
          var num = posts.length;
          var visible_posts = slicePosts(posts,num,page);
          renderPosts(visible_posts); 
          $(window).trigger('resize');
          truncate();     
        }
      });
    }
    else
    {
      $('#light-pagination').pagination('destroy');
    }
  }   

  $('.searchButton').on('click', function () {
    q = $('.searchTerm').val().trim();
    if(!q.length)
    {
      $.growl.warning({ message: msg_search_empty });
    }
    else
    {
      $appPostsContainer.append($loader);
      search_posts(q, function(posts) {
        localStorage.app_posts = JSON.stringify(posts);
        localStorage.app_url = url_search;
        var num = posts.length;
        var visible_posts = slicePosts(posts,num,1);
        $appPostsContainer.find('.loader').remove();
        renderPosts(visible_posts);
        renderPagination(num); 
        $(window).trigger('resize');
        truncate();
      });       
    }
  });

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
            status_id: row.status_id,
            title: row.title, 
            excerpt: row.excerpt, 
            img: row.photos.length > 0 ? row.photos[0].url : '',
            source_app: row.source,
            source_post: '/posts/'+row.id,
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

  get_posts(function(posts) {
    //console.log(posts);
    localStorage.app_posts = JSON.stringify(posts);
    localStorage.app_url = url_api;
    var num = posts.length;
    var visible_posts = slicePosts(posts,num,1);
    //$appPostsContainer.find('.app-loader').remove();
    renderPosts(visible_posts);
    renderPagination(num);
    $(window).trigger('resize');
    truncate();
  });
})
