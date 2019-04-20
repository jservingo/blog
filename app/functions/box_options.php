<?php 
  if($post->isCatalog()){
  $title = "Nombre del catálogo";
  $msg_update = "El catálogo fue actualizado";
  $opc_featured = "El catálogo aparecerá entre los primeros.";
  $opc_privacy = "Solamente el propietario puede ver el catálogo.";
  $opc_restricted = "Solamente el propietario puede reenviar el catálogo.";
  } 
  elseif($post->isPage()) {
  $title = "Nombre de la página";
  $msg_update = "La página fue actualizada";
  $opc_featured = "La página aparecerá entre las primeras.";
  $opc_privacy = "Solamente el propietario puede ver la página.";
  $opc_restricted = "Solamente el propietario puede reenviar la página.";
  //Campos que no están en el post
  $page = $post->page;
  $cstr_allow_subscribers = $page->cstr_allow_subscribers;
  $cstr_show_subscribers = $page->cstr_show_subscribers;
  $cstr_main_page = $page->cstr_main_page; 
  }
  elseif($post->isUser()) {
  $title = "Nombre del usuario";
  $msg_update = "El usuario fue actualizado";
  $opc_featured = "El usuario aparecerá entre los primeros.";
  $opc_privacy = "Solamente el propietario puede ver el post.";
  $opc_restricted = "Solamente el propietario puede reenviar el post.";
  }
  elseif($post->isCompany()) {
  $title = "Nombre de la empresa";
  $msg_update = "La empresa fue actualizada";
  $opc_featured = "La empresa aparecerá entre las primeras.";
  $opc_privacy = "Solamente el propietario puede ver la empresa.";
  $opc_restricted = "Solamente el propietario puede reenviar la empresa.";
  }
  else {
  $title = "Título del post"; 
  $msg_update = "El post fue actualizado";
  $opc_featured = "El post aparecerá entre los primeros."; 
  $opc_privacy = "Solamente el propietario puede ver el post.";
  $opc_restricted = "Solamente el propietario puede reenviar el post.";  
  }
?>