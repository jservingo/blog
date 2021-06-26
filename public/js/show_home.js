// Show home posts
$(function() {  
	var template_row_home = '<div class="row_home" style="background-color::zcolor:">'+
		'<div style="float:right"'+
			'<div style="float:right;">'+
        '<div class="truncate" data-height="12" style="width: 100px; padding: 4px 10px; text-align: right; height: 18px;">'+
          '<span class="user c-blue">'+
            '<a id="t-user" href=":owner_post:">'+
              ':owner_name:'+
            '</a>'+
          '</span>'+
        '</div>'+
        '<div class="truncate" data-height="12" style="width: 100px; padding: 4px 10px; text-align: right; height: 18px;">'+         
          '<span id="t-date" class="c-gray-1" style="">'+
            ':date:'+
          '</span>'+
        '</div>'+ 
      '</div>'+
      '<div style="float:left;">'+               
        '<div class="truncate content" data-height="34" style="width: 227px; padding: 8px 10px 0px;">'+      
          '<a href=":url_post:" class="text-uppercase c-blue" data-id=":post_id:">'+
            '<h1 id="t-title" class="t-title" style="margin-top:0;margin-bottom:6px">:title:</h1>'+  
          '</a>'+
        '</div>'+
      '</div>'+
      '<div style="clear:both;"></div>'+
    '</div>';

  function renderPosts(posts, el) {
  	var zcolor="#fefdfd";
		posts.rows.forEach(function (post) {
			var date = new Date(post.created_at);
			date = fdateLocal(date);
			var url_post = 'posts/'+post.id;
			switch(post.type_id)
			{
				case 21:
					url_post = 'catalogs/'+post.ref_id;
					break;
				case 22:
					url_post = 'pages/'+post.ref_id+'/0';
					break;
				case 23:
					url_post = 'apps/'+post.ref_id;
					break;
			}
      var post = template_row_home
        .replace(':title:', post.title)
        .replace(':url_post:', url_post)
        .replace(':post_id:', post.id)
        .replace(':owner_name:', post.owner.name)
        .replace(':owner_post:', '/user/'+post.owner.id)        
        .replace(':date:', date)
        .replace(':zcolor:', zcolor)

      if (zcolor=="#fefdfd")
        zcolor="#cee3ea";
      else
        zcolor="#fefdfd";

      var $post = $(post);
      var $container = $(el).find('#home_posts');
      $container.append($post);

			var elements = document.getElementsByClassName("truncate");
			for (var i = 0; i < elements.length; i++) {
				var element = elements[i]; 
				var height = parseInt(element.getAttribute('data-height'));		
				if (element.hasAttribute("data-adjust")) 
					var adjust = element.getAttribute('adjust');
				else 
					var adjust = "true";     
		  	truncateByHeight(element, ".t-excerpt", height);
		  	truncateByHeight(element, ".t-title", height);
		  	truncateByHeight(element, ".t-footnote", height);
		  	truncateByHeight(element, ".t-tags", height);
		  	if (adjust=="true")
		  		element.style.height = ((height) + "px");
			}
    });
  }

  show_user_stats();
  show_home_posts("recommendations");
  show_home_posts("offers");
  show_home_posts("favorites");
  show_home_posts("most_viewed");
  show_home_posts("recently_viewed");

  function show_user_stats()
	{  
	  $.ajax({
	    url: '/user_stats/get',
	    dataType: 'json',
	    success: function(data) {
	    	$('#t_username').text(data.username);
	      $('#c_received').text('('+data.received+')');
	      $('#c_notifications').text('('+data.notifications+')');
	      $('#c_alerts').text('('+data.alerts+')');
	      $('#c_contacts').text('('+data.contacts+')');
	      $('#c_apps').text('('+data.apps+')');
	      $('#c_pages').text('('+data.pages+')');
	      $('#c_catalogs').text('('+data.catalogs+')');
	      $('#c_posts').text('('+data.posts+')');
	      $('#c_apps_subscriptions').text('('+data.apps_subscriptions+')');
	      $('#c_pages_subscriptions').text('('+data.pages_subscriptions+')');
	    },
	    error: function (data) {
	      console.log('Error:', data);
	    }
	  }); 
	}

  function show_home_posts(type)
	{
		switch (type) 
		{
			case "recommendations":
				url = '/recommendations/get';
				get_home_posts(url, function(posts) {
					console.log(posts);
					renderPosts(posts,"#recommendations");
				});
				break;
			case "offers":
			  url = '/offers/get';
				get_home_posts(url, function(posts) {
					console.log(posts);
					renderPosts(posts,"#offers");
				});
				break;	
			case "favorites":
			  url = '/favorites/get';
				get_home_posts(url, function(posts) {
					console.log(posts);
					renderPosts(posts,"#favorites");
				});
				break;	
			case "most_viewed":
			  url = '/most_viewed/get'; 
				get_home_posts(url, function(posts) {
					console.log(posts);
					renderPosts(posts,"#most_viewed");
				});
				break;
			case "recently_viewed":
			  url = '/recent_views/get';
				get_home_posts(url, function(posts) {
					console.log(posts);
					renderPosts(posts,"#recently_viewed");
				});
				break;
		}
	}  

	function get_home_posts(url, callback)
	{  
	  $.ajax({
	    url: url,
	    dataType: 'json',
	    success: function(data) {
	      callback(data);
	    },
	    error: function (data) {
	      console.log('Error:', data);
	    }
	  }); 
	}
})