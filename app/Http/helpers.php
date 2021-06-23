<?php

function setActiveRoute($name)
{
    return request()->routeIs($name) ? 'active' : '';
}

function format_num($n) {
  $s = array("K", "M", "G", "T");
  $out = "";
  while ($n >= 1000 && count($s) > 0) {
    $n = $n / 1000.0;
    $out = array_shift($s);
  }
  return round($n, max(0, 3 - strlen((int)$n))) ." $out";
}

function getUTCDate()
{
  date_default_timezone_set('UTC');
  return ('Y-m-d H:i:s', time());
}

function create_session()
{
  session(['view_catalogs' => 'card']);
  session(['view_posts' => 'full']);
  session(['show_footer' => 'true']);
}

function get_view($root="posts")
{
  $view = session('view_posts');
  if (! $view)
    create_session(); 

  if ($root=="posts")
  {
    $view = session('view_posts');
    return 'posts.show_'.$view;
  }

  if ($root=="catalogs")
  {
    $view = session('view_catalogs');
    if ($view=="ribbon")
      return "ribbon";
    else
      return 'posts.show_'.$view;   
  }
}

?>
