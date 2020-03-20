@if ($post->featured)
	@if ($post->isNotification())
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured_notification.png" width="20" />
	  </div> 
	@elseif ($post->isAlert())
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured_alert.png" width="20" />
	  </div> 
	@elseif ($post->isOffer())
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured_offer.png" width="20" />
	  </div> 
	@elseif ($post->isCatalog())
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured_catalog.png" width="20" />
	  </div> 
	@elseif ($post->isPage())
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured_page.png" width="20" />
	  </div> 
	@elseif ($post->isApp())
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured_app.png" width="20" />
	  </div> 
	@elseif ($post->isUser())
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured_user.png" width="20" />
	  </div> 
	@else
	  <div style="position:absolute; top:-3px; left:-10px;">
	    <img src="/img/featured.png" width="20" />
	  </div> 
	@endif 
@endif