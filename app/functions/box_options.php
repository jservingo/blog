<?php 
  if($post->isCatalog()){
  $title = __('messages.catalog-title');
  $msg_update = __('messages.catalog-updated');
  $opc_featured = __('messages.catalog-featured');
  $opc_privacy = __('messages.catalog-privacy');
  $opc_restricted = __('messages.catalog-restricted');
  $catalog = $post->catalog;
  } 
  elseif($post->isPage()) {
  $title = __('messages.page-title');
  $msg_update = __('messages.page-updated');
  $opc_featured = __('messages.page-featured');
  $opc_privacy = __('messages.page-privacy');
  $opc_restricted = __('messages.page-restricted');
  //Campos que no están en el post
  $page = $post->page;
  $cstr_allow_subscribers = $page->cstr_allow_subscribers;
  $cstr_show_subscribers = $page->cstr_show_subscribers;
  $cstr_main_page = $page->cstr_main_page; 
  }
  elseif($post->isUser()) {
  $title = __('messages.user-title');
  $msg_update = __('messages.user-updated');
  $opc_featured = __('messages.user-featured');
  $opc_privacy = __('messages.user-privacy');
  $opc_restricted = __('messages.user-restricted');
  }
  elseif($post->isCompany()) {
  $title = __('messages.company-title');
  $msg_update = __('messages.company-updated');
  $opc_featured = __('messages.company-featured');
  $opc_privacy = __('messages.company-privacy');
  $opc_restricted = __('messages.company-restricted');
  }
  else {
  $title = __('messages.post-title'); 
  $msg_update = __('messages.post-updated');
  $opc_featured = __('messages.post-featured'); 
  $opc_privacy = __('messages.post-privacy');
  $opc_restricted = __('messages.post-restricted');  
  }
?>