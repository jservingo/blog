<?php

//Web Routes (cambiado)

//Info
Route::get('about','InfoController@about')->name('info.about');
Route::get('support','InfoController@support')->name('info.support');
Route::get('contact','InfoController@contact')->name('info.contact');
Route::get('ad/contact','InfoController@ad_contact')->name('info.ad_contact');

//Konetsys
Route::get('konetsys','KonetsysController@index')->name('konetsys');
Route::get('konetsys/about','KonetsysController@about')->name('konetsys.about');
Route::get('konetsys/support','KonetsysController@support')->name('konetsys.support');
Route::get('konetsys/contact','KonetsysController@contact')->name('konetsys.contact');

Route::get('email',function(){
	return new App\Mail\LoginCredentials(App\User::first(),'123456');
});

//Google, verify that you own the website
Route::get('/google/verify', function () {
    return file_get_contents(public_path().'/google6e785e14523272c5.html'); 
});

//Password reset
Route::get('password/reset', function () {
    return view('auth.passwords.reset');
});

//Home & User 
Route::get('/','HomeController@index')->name('home');
Route::get('user/login','HomeController@login')->name('login');
Route::get('user/register','HomeController@register')->name('register');
Route::get('user/language','HomeController@change_language')->name('language');
Route::get('user/configuration','HomeController@configuration')->name('configuration');
Route::get('user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('user/account','HomeController@show_account')->name('account');
Route::get('user/{user}/{url?}','PostsController@show_user')->name('post.show_user');
Route::get('ad/{position1}/{position2}','HomeController@get_ad');
Route::get('colorpicker', function () {
    return view('home.color_picker');
});

//User stats, recommendations, recent views, favorites, most_viewed
Route::get('recommendations','HomeController@show_recommendations')->name('home.show_recommendations');
Route::get('offers','HomeController@show_offers')->name('home.show_offers');
Route::get('favorites','HomeController@show_favorites')->name('home.show_favorites');
Route::get('most/viewed','HomeController@show_most_viewed')->name('home.show_most_viewed');
Route::get('recent/views','HomeController@show_recent_views')->name('home.show_recent_views');
Route::get('user_stats/get','HomeController@get_user_stats');
Route::get('alerts/get','HomeController@get_alerts');
Route::get('recommendations/get','HomeController@get_recommendations');
Route::get('offers/get','HomeController@get_offers');
Route::get('offers/random/get/{num}','HomeController@get_random_offers');
Route::get('favorites/get','HomeController@get_favorites');
Route::get('most_viewed/get','HomeController@get_most_viewed');
Route::get('recent_views/get','HomeController@get_recent_views');
Route::post('recent_views','HomeController@store_recent_views');

//Set session message
Route::post('message','HomeController@set_message');

//Set session view (show_mode)
Route::post('view','HomeController@set_view');

//Apps
Route::get('apps/discover','AppsController@discover')->name('apps.discover');
Route::get('apps','AppsController@show_all')->name('apps.show_all');
Route::get('apps/created','AppsController@show_created')->name('apps.show_created');
Route::get('apps/created-by/{user}/{url?}','AppsController@show_created_by_user')->name('apps.show_created_by_user');
Route::get('apps/{app}/{url?}','AppsController@show_app')->name('app.show_app');
Route::get('app/subscribers/{app}/{url?}','AppsController@show_subscribers')->name('apps.show_subscribers');
Route::get('app/get/posts/{app}','AppsController@get_posts');
Route::post('app/get/post','AppsController@get_post');
Route::post('apps/post','AppsController@save_app_post');
Route::post('app','AppsController@store')->name('app.create');
Route::delete('apps/{post}','AppsController@destroy');

//App Last.fm
Route::get('artists/generate','ArtistsController@generate_artists')->name('artists.generate');
Route::get('artists/create/{i}','ArtistsController@create_artists')->name('artists.create');
Route::get('artists/get/all','ArtistsController@get_all')->name('artists.get_all');
Route::get('artists/show/{mbid}','ArtistsController@show_post')->name('artists.show_post');
Route::get('artists/search/{q}','ArtistsController@search')->name('artists.search');
Route::post('artists/save','ArtistsController@save_post')->name('artists.save_post');
Route::post('artists/get/image','ArtistsController@get_image')->name('artists.get_image');
Route::delete('artists/{mbid}','ArtistsController@destroy');

//Pages
Route::get('pages/discover','PagesController@discover')->name('pages.discover');
Route::get('pages/visited','PagesController@show_visited')->name('pages.show_visited');
Route::get('pages/all','PagesController@show_all')->name('pages.show_all');
Route::get('pages/created','PagesController@show_created')->name('pages.show_created');
Route::get('pages/created-by/{user}/{url?}','PagesController@show_created_by_user')->name('pages.show_created_by_user');
Route::get('pages/{page}/{category}/{url?}','PagesController@show_page_category')->name('page.show_page_category');
Route::get('page/subscribers/{page}/{url?}','PagesController@show_subscribers')->name('page.show_subscribers');
Route::get('page/{page}','PagesController@edit')->name('page.edit');
Route::get('page/change_user/{page}/{user_id}','PagesController@change_user')->name('page.change_user');
Route::get('page/isOwner/{page}','PagesController@isOwner')->name('page.isOwner');
Route::get('page/stats/{post}','PagesController@get_stats')->name('page.get_stats');
Route::post('page/allocate','PagesController@allocate')->name('page.allocate');
Route::post('page','PagesController@store')->name('page.create');
Route::delete('pages/{post}','PagesController@destroy');

//Subscriptions
Route::get('subscriptions','SubscriptionsController@show')->name('subscriptions.show');
Route::get('subscriptions/pages','SubscriptionsController@show_pages')->name('subscriptions.show_pages');
Route::get('subscriptions/apps','SubscriptionsController@show_apps')->name('subscriptions.show_apps');
Route::post('subscriptions/add','SubscriptionsController@add_subscription');
Route::delete('subscriptions/{post}','SubscriptionsController@destroy');

//Contacts
Route::get('contacts/discover','ContactsController@discover')->name('contacts.discover');
Route::get('contacts/get','ContactsController@get_contacts');
Route::get('contacts/tree','ContactsController@get_contacts_tree');
Route::get('contacts/{group}','ContactsController@show_group')->name('contacts.show_group');
Route::get('contacts','ContactsController@show_contacts')->name('contacts.show_contacts');
Route::get('contacts/stats/{post}','ContactsController@get_stats')->name('contacts.get_stats');
Route::post('contacts/create','ContactsController@create_node');
Route::post('contacts/rename','ContactsController@rename_node');
Route::post('contacts/delete','ContactsController@delete_node');
Route::post('contacts/add','ContactsController@add_user_to_contacts');
Route::post('contacts/send/post','ContactsController@send_post');
Route::post('contacts/send/message','ContactsController@send_message');
Route::delete('contacts/group/{post}/{group}','ContactsController@delete_contact_from_group');
Route::delete('contacts/{post}','ContactsController@destroy');

//Categories
Route::get('categories/tree/{page}','CategoriesController@get_categories_tree');
Route::get('categories/{category}','CategoriesController@show_category')->name('category.show_category');
Route::post('categories/create','CategoriesController@create_node');
Route::post('categories/rename','CategoriesController@rename_node');
Route::post('categories/delete','CategoriesController@delete_node');

//Catalogs
Route::get('catalogs/discover','CatalogsController@discover')->name('catalogs.discover');
Route::get('catalogs/all','CatalogsController@show_all')->name('catalogs.show_all');
Route::get('catalogs/created','CatalogsController@show_created')->name('catalogs.show_created');
Route::get('catalogs/created-by/{user}/{url?}','CatalogsController@show_created_by_user')->name('catalogs.show_created_by_user');
Route::get('catalogs/{catalog}/{url?}','CatalogsController@show_catalog')->name('catalog.show_catalog');
Route::get('catalog/{catalog}','CatalogsController@edit')->name('catalog.edit');
Route::get('catalog/stats/{post}','CatalogsController@get_stats')->name('catalog.get_stats');
Route::get('catalog/isOwner/{catalog}','CatalogsController@isOwner')->name('catalog.isOwner');
Route::post('catalog','CatalogsController@store')->name('catalog.create');
Route::delete('catalogs/{category}/{post}','CatalogsController@delete_catalog_from_category');	
Route::delete('catalogs/{post}','CatalogsController@destroy');

//Posts
Route::get('posts/discover','PostsController@discover')->name('posts.discover');
Route::get('posts/received/{status?}/{type?}','PostsController@show_received')->name('posts.show_received');
Route::get('posts/notifications','PostsController@show_notifications')->name('posts.show_notifications');
Route::get('posts/alerts','PostsController@show_alerts')->name('posts.show_alerts');
Route::get('posts/alerts/notifications','PostsController@show_alerts_notifications')->name('posts.show_alerts_notifications');
Route::get('posts/sent/{type?}','PostsController@show_sent')->name('posts.show_sent');
Route::get('posts/all/{type?}','PostsController@show_all')->name('posts.show_all');
Route::get('posts/created/{type?}','PostsController@show_created')->name('posts.show_created');
Route::get('posts/created-by/{user}/{type?}/{url?}','PostsController@show_created_by_user')->name('posts.show_created_by_user');
Route::get('posts/{post}/{url?}','PostsController@show_post')->name('post.show');
Route::get('post/{post}','PostsController@edit')->name('post.edit');
Route::get('post/footer/{post}','PostsController@edit_footer')->name('post.edit_footer');
Route::get('post/iframe/{post}/{url?}','PostsController@show_iframe')->name('post.show_iframe');
Route::get('post/isOwner/{post}','PostsController@isOwner')->name('post.isOwner');
Route::get('post/isSaved/{post}','PostsController@isSaved')->name('post.isSaved');
Route::post('post','PostsController@store')->name('post.create');
Route::post('posts/save','PostsController@save_post');
Route::post('posts/discard','PostsController@discard_post');
Route::post('posts/likes/{post}/{mode}','PostsController@update_likes');
Route::put('post/{post}','PostsController@update')->name('post.update');
Route::put('post/footer/{post}','PostsController@update_footer')->name('post.update_footer');
Route::delete('posts/{catalog}/{post}','PostsController@delete_post_from_catalog');	
Route::delete('posts/{post}','PostsController@destroy');

//Audios
Route::get('audios/get/{post}','AudiosController@get_audios');
Route::post('audio/upload','AudiosController@upload')->name('audio.upload');
Route::post('audio/{post}','AudiosController@store')->name('audio.create');
Route::put('audio/{audio}','AudiosController@update')->name('audio.update');
Route::delete('audios/{audio}','AudiosController@destroy')->name('audio.destroy');

//Types & Tags
Route::get('types/{type}','TypesController@show')->name('types.show');
Route::get('tags/{tag}','TagsController@show')->name('tags.show');

//Clipboard
Route::get('clipboards/contacts','ClipboardsController@get_contacts');
Route::get('clipboards/catalogs','ClipboardsController@get_catalogs');
Route::get('clipboards/posts','ClipboardsController@get_posts');
Route::post('clipboards/copy/contact','ClipboardsController@copy_contact');
Route::post('clipboards/copy/catalog','ClipboardsController@copy_catalog');
Route::post('clipboards/copy/post','ClipboardsController@copy_post');
Route::post('clipboards/copy/app/post','ClipboardsController@copy_app_post');
Route::post('clipboards/paste/contact','ClipboardsController@paste_post_to_contacts');
Route::post('clipboards/paste/catalog','ClipboardsController@paste_catalog_to_category');
Route::post('clipboards/paste/post','ClipboardsController@paste_post_to_catalog');
Route::delete('clipboards/{clipboard}','ClipboardsController@destroy');

Route::auth();

Route::group([
	'prefix'=>'admin',
	'namespace'=>'Admin',
	'middleware'=>'auth'],
  function(){
	Route::get('/','AdminController@index')->name('dashboard');
	
	Route::get('posts','PostsController@index')->name('admin.posts.index');
	Route::get('posts/create','PostsController@create')->name('admin.posts.create');
	Route::post('posts','PostsController@store')->name('admin.posts.store');
	Route::get('posts/{post}','PostsController@edit')->name('admin.posts.edit');
	Route::put('posts/{post}','PostsController@update')->name('admin.posts.update');
	Route::delete('posts/{post}','PostsController@destroy')->name('admin.posts.destroy');

	Route::get('users','UsersController@index')->name('admin.users.index');
	Route::get('users/create','UsersController@create')->name('admin.users.create');
	Route::post('users','UsersController@store')->name('admin.users.store');
	Route::get('users/{user}/edit','UsersController@edit')->name('admin.users.edit');
	Route::get('users/{user}','UsersController@show')->name('admin.users.show');
	Route::put('users/{user}','UsersController@update')->name('admin.users.update');	
	Route::delete('users/{user}','UsersController@destroy')->name('admin.users.destroy');	

	Route::get('roles','RolesController@index')->name('admin.roles.index');
	Route::get('roles/create','RolesController@create')->name('admin.roles.create');
	Route::post('roles','RolesController@store')->name('admin.roles.store');
	Route::get('roles/{rol}/edit','RolesController@edit')->name('admin.roles.edit');
	Route::get('roles/{rol}','RolesController@show')->name('admin.roles.show');
	Route::put('roles/{rol}','RolesController@update')->name('admin.roles.update');	
	Route::delete('roles/{rol}','RolesController@destroy')->name('admin.roles.destroy');	

	Route::put('users/{user}/roles','UsersRolesController@update')->name('admin.users.roles.update');	
	Route::put('users/{user}/permissions','UsersPermissionsController@update')->name('admin.users.permissions.update');
	
	Route::post('posts/{post}/photos','PhotosController@store')->name('admin.posts.photos.store');
	Route::delete('photos/{photo}','PhotosController@destroy')->name('admin.photos.destroy');
});

/*
Route::get('/', function () {
    $posts = App\Post::latest('published_at')->get();
    return view('welcome', compact('posts'));
});
*/

/*
Route::get('/posts', function () {
    return App\Post::all();
});
*/

/*
Route::get('/home','HomeController@index');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');
*/
