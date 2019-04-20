$(function() {
  //var $appPostsContainer = $('#app-body').find('.tv-shows');
  var $appPostsContainer = $('#posts_container').find('.app-posts');
  var $pagination = $('#pagination');
  var per_page= 10;

  /*
  $('#light-pagination').pagination({
    itemsOnPage: 10,
    cssStyle: 'light-theme',
    onPageClick(pageNumber, event){
      $appPostsContainer.find('.app-loader').remove();
      var posts = JSON.parse(localStorage.posts);
      var num = posts.length;
      var visible_posts = slicePosts(posts,num,page);
      renderPosts(visible_posts);      
    }
  });
  */

var template = '<div class="post pfull">'+
  '<div class="content-post" style="background-color:#fefdfd">'+
    '<div style="float:right;">'+
      '<div class="header" style="float:right;">'+
        '<header class="xcontainer-flex xspace-between">'+
        '<div class="date truncate" data-height="51" style="width: 20px; padding: 10px 5px 2px 10px; background-color: rgb(254, 253, 253); height: 51px;">'+
          '<div>'+ 
            '<div class="popr box_popup" style="position:absolute; top:10px; right:5px;" data-id="7">'+
              '<img src="/img/options.png" width="20">'+
            '</div>'+ 
          '</div>'+ 
          '</div>'+
          '<!-- Nothing -->'+
        '</header>'+
      '</div>'+
      '<div style="float:left;">'+
        '<div class="content" style="width: 578px; background-color: rgb(254, 253, 253); padding: 8px 10px 0px;">'+      
          '<a href=":url:" target="_blank" class="text-uppercase c-blue" data-id="7">'+
            '<h1 class="t-title" style="margin-top:0;margin-bottom:6px">:name:</h1>'+  
          '</a>'+
        '</div>'+            
      '</div>'+
      '<div style="clear:both;"></div>'+
      '<div>'+
        '<div class="scontent" style="width: 605px; background-color: rgb(254, 253, 253); padding: 2px 10px 10px; text-align: justify;">'+
          '<a href=":url:" class="t-excerpt c-negro" data-id="7">'+
            ':summary:'+
          '</a>'+
        '</div>'+
      '</div>'+
    '</div>'+
    '<div class="media" style="float:left;">'+
      '<div style="width:345px; height:auto; overflow:auto; background-color:#d7e9f3">'+
      '<img src=":img:" alt=":img alt:" class="img-responsive ifull">'+
      '</div>'+
    '</div>'+
    '<div style="clear:both;"></div>'+      
    '<div>'+
      '<div style="float:right;">'+
        '<div class="truncate" data-height="18" style="width: 210px; background-color: rgb(254, 253, 253); padding: 4px 10px; text-align: right; height: 18px;">'+
          '<span class="user c-blue">'+
            '<a href="https://www.tvmaze.com/">'+
              'TVMaze'+
            '</a>'+
            '&nbsp;&nbsp;'+
          '</span>'+
          '<span class="c-gray-1" style="">'+
            '25 Jan 2019'+
          '</span>'+
        '</div>'+ 
      '</div>'+
      '<div style="float:left;">'+               
        '<div class="truncate footnote" data-height="24" data-adjust="false" style="width: 723px; color: rgb(21, 85, 151); font-weight: 800; background-color: rgb(254, 253, 253); padding: 6px 10px;">'+     
          '<div class="t-footnote">'+
            'tags tags tags tags tags tags tags tags tags tags tags tags tags tags tags tagstags tags tags tags tags tags ...'+
          '</div>'+ 
        '</div>'+
      '</div>'+
      '<div style="clear:both;"></div>'+
    '</div>'+
    '<div>'+
      '<div style="float:right;">'+
        '<footer class="xcontainer-flex xspace-between" style="width:210px; height:24px; background-color:#fefdfd; padding: 6px 10px; text-align:right;">'+
          '<a class="btn_copy_app_post" data-source=":href:" data-id=":app_id:" data-custom_type=":custom_type:">'+
            '<img src="/img/copy.png" width="24">'+
          '</a>'+
          '<a class="btn_save_app_post" data-source=":href:" data-id=":app_id:" data-custom_type=":custom_type:">'+ 
            '<img src="/img/save.png" width="24">'+
          '</a>'+
        '</footer>'+ 
      '</div>'+
      '<div style="float:left;">'+               
        '<div class="truncate footnote" data-height="24" data-adjust="false" style="width: 723px; color: rgb(29, 113, 167); font-weight: 800; background-color: rgb(254, 253, 253); padding: 6px 10px;">'+     
          '<div class="t-footnote">'+
            'footnote footnote footnote footnote footnote footnote footnote footnote footnote footnote footnote ...'+
          '</div>'+
        '</div>'+
      '</div>'+
      '<div style="clear:both;"></div>'+
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
    visible_posts.forEach(function (post) {
      var post = template
        .replace(':name:', post.name)
        .replace(':img:', post.image ? post.image.medium : '')
        .replace(':summary:', post.summary)
        .replace(':url:', post.url)
        .replace(':url:', post.url)
        .replace(':href:', post._links.self.href)
        .replace(':href:', post._links.self.href)
        .replace(':img alt:', post.name + " Logo")
        .replace(':app_id:', app_id)
        .replace(':app_id:', app_id)
        .replace(':custom_type:', 'Show')
        .replace(':custom_type:', 'Show')

      var $post = $(post)
      $appPostsContainer.append($post.fadeIn(1500));
    })    
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
          $appPostsContainer.find('.app-loader').remove();
          var posts = JSON.parse(localStorage.posts);
          var num = posts.length;
          var visible_posts = slicePosts(posts,num,page);
          renderPosts(visible_posts);      
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
      alert("Add some text friend");
    }
    else
    {   
      url = 'http://api.tvmaze.com/search/shows?q='+q;
      $.ajax(url)
      .then(function (res) { 
          var posts = res.map(function (el) {
            return el.show;
          })
          localStorage.posts = JSON.stringify(posts);
          localStorage.app_url = url;
          var num = posts.length;
          var visible_posts = slicePosts(posts,num,1);
          $appPostsContainer.find('.app-loader').remove();
          renderPosts(visible_posts);
          renderPagination(num);        
      })
    }
  }); 

  var url = 'http://api.tvmaze.com/shows';
  if (!localStorage.posts || localStorage.app_url != url)
  {
    $.ajax(url)
      .then(function (posts) {        
        localStorage.posts = JSON.stringify(posts);
        localStorage.app_url = url;
        var num = posts.length;
        var visible_posts = slicePosts(posts,num,1);
        $appPostsContainer.find('.app-loader').remove();
        renderPosts(visible_posts);
        renderPagination(num);
      })
  } else {
    posts = JSON.parse(localStorage.posts);
    var num = posts.length;
    var visible_posts = slicePosts(posts,num,1);
    $appPostsContainer.find('.app-loader').remove();
    renderPosts(visible_posts);
    renderPagination(num);
  }  
})

 
