// Find all YouTube videos
var $allVideos = $("iframe[src^='https://www.youtube.com']");

// Figure out and save aspect ratio for each video
$allVideos.each(function() {
  $(this)
    .data('aspectRatio', this.height / this.width)
    .removeAttr('height')
    .removeAttr('width');
});

// When the window is resized
$(window).resize(function() {
  var container_width = $("#content-post").width-40;
  var newWidth = Math.min(600,container_width);
  alert(container_width);
  alert(newWidth);

  // Resize all videos according to their own aspect ratio
  $allVideos.each(function() {
    var $el = $(this);
    $el
      .width(newWidth)
      .height(newWidth * $el.data('aspectRatio'))
      .css('visibility', 'visible');

    //$el.closest('.video').css('visibility', 'visible');
    //alert(newWidth * $el.data('aspectRatio'));
  });

  // Kick off one resize to fix all videos on page load
}).resize();
