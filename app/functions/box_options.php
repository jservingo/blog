<?php 
  if($post->isCatalog()){
  $title = "Catalog title";
  $msg_update = "The catalog was updated.";
  $opc_featured = "Featured: The catalog will appear among the first.";
  $opc_privacy = "Only the owner can see the catalog.";
  $opc_restricted = "Only the owner can forward the catalog.";
  } 
  elseif($post->isPage()) {
  $title = "Page Title";
  $msg_update = "The page was updated.";
  $opc_featured = "Featured: The page will appear among the first.";
  $opc_privacy = "Only the owner can see the page.";
  $opc_restricted = "Only the owner can forward the page.";
  //Campos que no están en el post
  $page = $post->page;
  $cstr_allow_subscribers = $page->cstr_allow_subscribers;
  $cstr_show_subscribers = $page->cstr_show_subscribers;
  $cstr_main_page = $page->cstr_main_page; 
  }
  elseif($post->isUser()) {
  $title = "Name";
  $msg_update = "The user was updated.";
  $opc_featured = "Featured: The user will appear among the first.";
  $opc_privacy = "Only the owner can see the user.";
  $opc_restricted = "Only the owner can forward the user.";
  }
  elseif($post->isCompany()) {
  $title = "Company name";
  $msg_update = "The company was updated.";
  $opc_featured = "Featured: The company will appear among the first.";
  $opc_privacy = "Only the owner can see the company.";
  $opc_restricted = "Only the owner can forward the company.";
  }
  else {
  $title = "Post title"; 
  $msg_update = "The post was updated.";
  $opc_featured = "Featured: The post will appear among the first."; 
  $opc_privacy = "Only the owner can see the post.";
  $opc_restricted = "Only the owner can forward the post.";  
  }
?>