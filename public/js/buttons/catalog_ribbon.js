// CATALOG RIBBON

//$('.catalog-buttons').hide();

$('.catcont').bind('mouseover',function(e) {
  var id = $(this).data("id");
  //$('#catalog_buttons'+id).show();
});

$('.catcont').bind('mouseout',function(e) {
  var id = $(this).data("id");
  //$('#catalog_buttons'+id).hide();
});

$('.go-xleft').bind('click', function(e){
  var id = $(this).data("id"); 
  for(i=0;i<=3;i++)
    $('#slider'+id).diyslider('move', 'back');
});

$('.go-left').bind('click', function(e){
  var id = $(this).data("id");
  $('#slider'+id).diyslider('move', 'back');
});

$('.go-right').bind('click', function(e){
  var id = $(this).data("id");
  $('#slider'+id).diyslider('move', 'forth');
});

$('.go-xright').bind('click', function(e){
  var id = $(this).data("id");
  for(i=0;i<=3;i++)
    $('#slider'+id).diyslider('move', 'forth');
});
