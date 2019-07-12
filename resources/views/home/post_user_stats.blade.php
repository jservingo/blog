{{-- home.post_user_stats --}}

<div class="post pexp">     
  <div class="content-post">
  	<ul>
			<li>
				<a class="vlink" href="{{ route('posts.show_received',0) }}">
          Received <span id="c_received"></span>
      	</a>
			</li>
			<li>
				<a class="vlink" href="{{ route('posts.show_notifications') }}">
          Notifications <span id="c_notifications"></span>
      	</a>				
			</li>
			<li>
				<a class="vlink" href="{{ route('contacts.show_contacts') }}">
          Contacts <span id="c_contacts"></span>
      	</a>
			</li>
			<li>My Stuff
				<ul>
					<li>
						<a class="vlink" href="{{ route('apps.show_created') }}">
          		Apps <span id="c_apps"></span>
      			</a>
      		</li>
					<li>
						<a class="vlink" href="{{ route('pages.show_created') }}">
          		Pages <span id="c_pages"></span>
      			</a>
      		</li>
					<li>
						<a class="vlink" href="{{ route('catalogs.show_created') }}">
          		Catalogs <span id="c_catalogs"></span>
      			</a>
					</li>
					<li>
						<a class="vlink" href="{{ route('posts.show_created') }}">
          		Posts <span id="c_posts"></span>
      			</a>
					</li>
				</ul>
			</li>
			<li>Subscriptions
				<ul>
			  	<li>
						<a class="vlink" href="{{ route('subscriptions.show_apps') }}">
          		Apps <span id="c_apps_subscriptions"></span>
      			</a>
					</li>
					<li>
						<a class="vlink" href="{{ route('subscriptions.show_pages') }}">
          		Pages <span id="c_pages_subscriptions"></span>
      			</a>
					</li>
				</ul>
			</li>
		</ul>	
	</div>
</div>	

