$(function() {  
  get_ad(1,1, function(ad1) {
  	$('#ad1').attr('href',ad1.url);
  	var photo1 = "/storage/"+ad1.photo;
  	$('#ad1').find('img').attr('src',photo1);
  });

  get_ad(2,2, function(ad2) {
  	$('#ad2').attr('href',ad2.url);
  	var photo2 = "/storage/"+ad2.photo;
  	$('#ad2').find('img').attr('src',photo2);
  });

  get_ad(3,3, function(ad3) {
  	$('#ad3').attr('href',ad3.url);
  	var photo3 = "/storage/"+ad3.photo;
  	$('#ad3').find('img').attr('src',photo3);
  });

  get_ad(4,4, function(ad4) {
  	$('#ad4').attr('href',ad4.url);
  	var photo4 = "/storage/"+ad4.photo;
  	$('#ad4').find('img').attr('src',photo4);
  });

  get_ad(5,5, function(ad5) {
  	$('#ad5').attr('href',ad5.url);
  	var photo5 = "/storage/"+ad5.photo;
  	$('#ad5').find('img').attr('src',photo5);
  });

  get_ad(6,6, function(ad6) {
  	$('#ad6').attr('href',ad6.url);
  	var photo6 = "/storage/"+ad6.photo;
  	$('#ad6').find('img').attr('src',photo6);
  });

	function get_ad(position1, position2, callback)
	{  
	  $.ajax({
	    url: '/ad/'+position1+'/'+position2,
	    dataType: 'json',
	    success: function(data) {
	      callback(data);
	    },
	    error: function (data) {
	      console.log('Error:', data);
	    }
	  }); 
	}

	// Show home posts

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
			date = date.toLocaleString('en-US',
				{"year":"numeric","month":"short","day":"2-digit"}
			);
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
        .replace(':owner_post:', 'post/user/'+post.owner.id)        
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
	      $('#c_received').text('('+data.received+')');
	      $('#c_notifications').text('('+data.notifications+')');
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