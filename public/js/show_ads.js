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
})