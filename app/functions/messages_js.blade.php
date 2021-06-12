<script>
  var lang = "<?=__('messages.lang');?>";
  var msg_want_to_save_this_post = "<?=__('messages.want-to-save-this-post');?>";
  var msg_want_to_subscribe = "<?=__('messages.want-to-subscribe');?>";
  var msg_want_to_add_this_user_to_your_contacts = "<?=__('messages.want-to-add-this-user-to-your-contacts');?>";
  var msg_want_to_discard_this_post = "<?=__('messages.want-to-discard-this-post');?>";
  var msg_the_post_was_saved = "<?=__('messages.the-post-was-saved');?>";
  var msg_the_post_was_not_saved = "<?=__('messages.the-post-was-not-saved');?>";
  var msg_the_subscription_was_successful = "<?=__('messages.the-subscription-was-successful');?>";
  var msg_the_subscription_has_failed = "<?=__('messages.the-subscription-has-failed');?>";
  var msg_the_user_was_added_to_your_contacts = "<?=__('messages.the-user-was-added-to-your-contacts');?>";
  var msg_the_user_was_not_added_to_your_contacts = "<?=__('messages.the-user-was-not-added-to-your-contacts');?>";
  var msg_the_post_was_discarded = "<?=__('messages.the-post-was-discarded');?>";
  var msg_the_post_was_not_discarded = "<?=__('messages.the-post-was-not-discarded');?>";
  var msg_the_post_was_added_to_the_clipboard = "<?=__('messages.the-post-was-added-to-the-clipboard');?>";
  var msg_the_catalog_was_added_to_the_clipboard = "<?=__('messages.the-catalog-was-added-to-the-clipboard');?>";
  var msg_the_catalog_was_updated = "<?=__('messages.the-catalog-was-updated');?>";
  var msg_the_page_was_updated = "<?=__('messages.the-page-was-updated');?>";
  var msg_your_contacts_were_updated = "<?=__('messages.your-contacts-were-updated');?>";
  var msg_you_are_not_authorized_to_edit_the_post = "<?=__('messages.you-are-not-authorized-to-edit-the-post');?>";
  var msg_the_post_was_sent = "<?=__('messages.the-post-was-sent');?>";
  var msg_type_text = "<?=__('messages.type-text');?>";
  var msg_type_notification = "<?=__('messages.type-notification');?>";
  var msg_type_message = "<?=__('messages.type-message');?>";
  var msg_type_alert = "<?=__('messages.type-alert');?>";
  var msg_type_offer = "<?=__('messages.type-offer');?>";
  var msg_type_web_page = "<?=__('messages.type-web-page');?>";
  var msg_type_photo_gallery = "<?=__('messages.type-photo-gallery');?>";
  var msg_type_frame = "<?=__('messages.type-frame');?>";
  var msg_create_catalog = "<?=__('messages.create-catalog');?>";
  var msg_enter_catalog = "<?=__('messages.enter-catalog');?>";
  var msg_create_app = "<?=__('messages.create-app');?>";
  var msg_enter_app = "<?=__('messages.enter-app');?>";
  var msg_create_page = "<?=__('messages.create-page');?>";
  var msg_enter_page = "<?=__('messages.enter-page');?>";
  var msg_create_post = "<?=__('messages.create-post');?>";
  var msg_enter_post = "<?=__('messages.enter-post');?>";
  var msg_enter_message = "<?=__('messages.enter-message');?>";
  var msg_title = "<?=__('messages.title');?>";
  var msg_type = "<?=__('messages.type');?>";
  var msg_yes = "<?=__('messages.yes');?>";
  var msg_no = "<?=__('messages.no');?>";
  var msg_paste = "<?=__('messages.paste');?>";
  var msg_cancel = "<?=__('messages.cancel');?>";
  var msg_send = "<?=__('messages.send');?>";
  var msg_create = "<?=__('messages.create');?>";
  var msg_add = "<?=__('messages.add');?>";
  var msg_edit = "<?=__('messages.edit');?>";
  var msg_want_to_delete_this_catalog = "<?=__('messages.want-to-delete-this-catalog');?>";
  var msg_want_to_delete_this_post_from_the_catalog = "<?=__('messages.want-to-delete-this-post-from-the-catalog');?>";
  var msg_want_to_delete_this_post = "<?=__('messages.want-to-delete-this-post');?>";
  var msg_want_to_delete_this_app = "<?=__('messages.want-to-delete-this-app');?>";
  var msg_want_to_delete_this_page = "<?=__('messages.want-to-delete-this-page');?>";
  var msg_want_to_delete_this_contact = "<?=__('messages.want-to-delete-this-contact');?>";
  var msg_want_to_delete_this_audio = "<?=__('messages.want-to-delete-this-audio');?>";
  var msg_want_to_unsubscribe = "<?=__('messages.want-to-unsubscribe');?>";
  var msg_the_catalog_was_deleted = "<?=__('messages.the-catalog-was-deleted');?>";
  var msg_the_catalog_was_not_deleted = "<?=__('messages.the-catalog-was-not-deleted');?>";
  var msg_the_post_was_deleted = "<?=__('messages.the-post-was-deleted');?>";
  var msg_the_post_was_not_deleted = "<?=__('messages.the-post-was-not-deleted');?>";
  var msg_the_app_was_deleted = "<?=__('messages.the-app-was-deleted');?>";
  var msg_the_app_was_not_deleted = "<?=__('messages.the-app-was-not-deleted');?>";
  var msg_the_page_was_deleted = "<?=__('messages.the-page-was-deleted');?>";
  var msg_the_page_was_not_deleted = "<?=__('messages.the-page-was-not-deleted');?>";
  var msg_the_subscription_was_deleted = "<?=__('messages.the-subscription-was-deleted');?>";
  var msg_the_subscription_was_not_deleted = "<?=__('messages.the-subscription-was-not-deleted');?>";
  var msg_the_contact_was_deleted = "<?=__('messages.the-contact-was-deleted');?>";
  var msg_the_contact_was_not_deleted = "<?=__('messages.the-contact-was-not-deleted');?>";
  var msg_the_contact_was_deleted_from_the_list = "<?=__('messages.the-contact-was-deleted-from-the-list');?>";
  var msg_the_contact_was_not_deleted_from_the_list = "<?=__('messages.the-contact-was-not-deleted-from-the-list');?>";
  var msg_the_changes_were_saved = "<?=__('messages.the-changes-were-saved');?>";
  var msg_the_post_was_not_updated = "<?=__('messages.the-post-was-not-updated');?>";
  var msg_notifications_empty = "<?=__('messages.notifications-empty');?>";
  var msg_search_empty = "<?=__('messages.search-empty');?>";
  var msg_not_implemented = "<?=__('messages.not-implemented');?>"; 
  var msg_show_all = "<?=__('messages.show-all');?>";
  var msg_send_message = "<?=__('messages.send-message');?>";
  var msg_please_contact_sales = "<?=__('messages.please-contact-sales');?>"; 
  var msg_please_wait_loading = "<?=__('messages.please-wait-loading');?>";
  var msg_upload_audio = "<?=__('messages.upload-audio');?>";
  
  
</script>



