$(function() {
  //var $appPostsContainer = $('#app-body').find('.tv-shows');
  var $appPostsContainer = $('#posts_container').find('.app-posts');
  var $appPostsMenu = $('#app_posts_menu');
  var $pagination = $('#pagination');
  var app = get_info(app_id);
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

var template_menu = '<div class="popr-box" data-box-id=":post_id:">'+
  '<div class="popr-item" data-btn="btn_copy_app_post" data-id=":post_id:">Copy</div>'+
  '<div class="popr-item" data-btn="btn_save_app_post" data-id=":post_id:">Save</div>'+
  '</div>';

var template = '<div class="post pfull">'+
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
          '<a href=":url:" target="_blank" class="text-uppercase c-blue" data-id=":app_id:">'+
            '<h1 id="t-title" class="t-title" style="margin-top:0;margin-bottom:6px">:title:</h1>'+  
          '</a>'+
        '</div>'+            
      '</div>'+
      '<div style="clear:both;"></div>'+
      '<div>'+
        '<div class="scontent" style="width: 605px; background-color: rgb(254, 253, 253); padding: 2px 10px 10px; text-align: justify;">'+
          '<a href=":url:" id="t-excerpt" class="t-excerpt c-negro" data-id=":app_id:">'+
            ':excerpt:'+
          '</a>'+
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
          '<a class="btn_save_app_post"'+  
            ' data-id=":app_id:"'+
            ' data-source=":href:"'+
            ' data-custom_type=":custom_type:">'+
            '<img src="/img/save.png" width="24">'+
          '</a>'+
        '</footer>'+ 
      '</div>'+
      '<div style="float:left;">'+               
        '<div class="truncate footnote" data-height="24" data-adjust="false" style="width: 723px; color: rgb(29, 113, 167); font-weight: 800; background-color: rgb(254, 253, 253); padding: 6px 10px;">'+     
          '<div id="t-footnote" class="t-footnote">'+
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
    $appPostsMenu.empty();

    var post_id = 1;
    visible_posts.forEach(function (post) {
      var f = new Date();
      var date = f.getDate() + ' ' + get_month(f) + ' ' + f.getFullYear();
      var post = template
        .replace(':title:', post.title)
        .replace(':title:', post.title)
        .replace(':img:', post.img)
        .replace(':img:', post.img)
        .replace(':excerpt:', post.excerpt)
        .replace(':excerpt:', post.excerpt)
        .replace(':tags:', post.tags)
        .replace(':footnote:', post.footnote)
        .replace(':url:', post.url)
        .replace(':url:', post.url)
        .replace(':href:', post.href)
        .replace(':href:', post.href)
        .replace(':img alt:', post.title + " Logo")
        .replace(':app_id:', app_id)
        .replace(':app_id:', app_id)
        .replace(':app_id:', app_id)
        .replace(':app_id:', app_id)
        .replace(':post_id:', post_id)
        .replace(':post_id:', post_id)
        .replace(':owner_name:', owner_name)
        .replace(':owner_post:', owner_post)        
        .replace(':date:', date)
        .replace(':custom_type:', post.custom_type)
        .replace(':custom_type:', post.custom_type)

      var post_menu = template_menu
        .replace(':post_id:', post_id)
        .replace(':post_id:', post_id)
        .replace(':post_id:', post_id)

      var $post = $(post);
      var $post_menu = $(post_menu);

      $appPostsContainer.append($post.fadeIn(1500));
      $appPostsMenu.append($post_menu);

      post_id = post_id + 1;
    });

    $('.popr').popr();    
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
      app = get_info(app_id,q);
      search_posts(app_id,q, function(posts) {
        localStorage.posts = JSON.stringify(posts);
        localStorage.app_url = app.url_search;
        var num = posts.length;
        var visible_posts = slicePosts(posts,num,1);
        $appPostsContainer.find('.app-loader').remove();
        renderPosts(visible_posts);
        renderPagination(num); 
      });       
    }
  }); 

  var app = get_info(app_id);
  if (!localStorage.posts || localStorage.app_url != app.url_api)
  {
  	get_posts(app_id, function(posts) {
  		//console.log(posts);
  		localStorage.posts = JSON.stringify(posts);
    	localStorage.app_url = app.url_api;
    	var num = posts.length;
  		var visible_posts = slicePosts(posts,num,1);
  		$appPostsContainer.find('.app-loader').remove();
  		renderPosts(visible_posts);
  		renderPagination(num);
      $(window).trigger('resize');
  	});
  }
  else {
    posts = JSON.parse(localStorage.posts);
    var num = posts.length;
    var visible_posts = slicePosts(posts,num,1);
    $appPostsContainer.find('.app-loader').remove();
    renderPosts(visible_posts);
    renderPagination(num);
    $(window).trigger('resize');
  }
})

// FUNCTIONS

function get_info(app_id,q='')
{
	var info;
	switch (app_id) 
	{
		case 3:
			info = {
				title: 'TVMaze',
				url_web: "https://www.tvmaze.com/",
				url_api: "http://api.tvmaze.com/shows",	
				url_search: 'http://api.tvmaze.com/search/shows?q='+q		
			};
			break;
	}
	return info;	
}

function get_posts(app_id, callback)
{
	var app = get_info(app_id);
	switch (app_id) 
	{
		case 3:
			get_posts_from_tvmaze(app.url_api, function(posts) {
				callback(posts);
			});
			break;	
	}
}

function get_posts_from_tvmaze(url, callback)
{
	var posts = new Array();
	//alert(url);

	$.ajax(url)
  .then(function (rows) {  
  	rows.forEach(function (row) {
  		post = {
  			title: row.name, 
  			excerpt: row.summary, 
  			img: row.image ? row.image.medium : '',
  			url: row.url,
  			href: row._links.self.href,
  			custom_type: 'TV Show'
  		};
  		posts.push(post);
  	});    
  	callback(posts);
  })
}


function search_posts(app_id, q, callback)
{
	var app = get_info(app_id, q)	
	switch (app_id) 
	{
		case 3:
			search_posts_from_tvmaze(app.url_search, function(posts) {
        callback(posts);
      });
      break;        
	}
}

function search_posts_from_tvmaze(url, callback)
{
	var posts = new Array();

	$.ajax(url)
    .then(function (res) { 
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
	  			custom_type: 'Show'
	  		};
	  		posts.push(post);
	  	});
      callback(posts);
  	}) 
}
