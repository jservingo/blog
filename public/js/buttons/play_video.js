$('.btn_play_video').bind('click', function(e){
  e.preventDefault();
  var post_id = $(this).data("id");
  btn_play_video(post_id);
});

function btn_play_video(post_id)
{
	var myWidth = 500;
  var myHeight = 485;
  var left = (screen.width - myWidth) / 2;
  var top = (screen.height - myHeight) / 2;
  var myWindow = window.open('/post/iframe/'+post_id+'/play-video', 'Edit', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);  	
}