{{-- home.post_user_stats --}}

<div class="post pexp">     
  <div class="content-post">
  	<ul style="list-style: none;">
			<li>
				<a class="vlink" href="{{ route('posts.show_received',0) }}">
          {{ __('messages.received') }} <span id="c_received"></span>
      	</a>
			</li>
			<li>
				<a class="vlink" href="{{ route('posts.show_notifications') }}">
          {{ __('messages.notifications') }} <span id="c_notifications"></span>
      	</a>				
			</li>
			<li>
				<a class="vlink" href="{{ route('posts.show_alerts') }}">
          {{ __('messages.alerts') }} <span id="c_alerts"></span>
      	</a>				
			</li>
			<li>
				<a class="vlink" href="{{ route('contacts.show_contacts') }}">
          {{ __('messages.contacts') }} <span id="c_contacts"></span>
      	</a>
			</li>
			<li style="font-weight:bold;">{{ __('messages.created') }}
				<ul>
					<li>
						<a class="vlink" href="{{ route('apps.show_created') }}">
          		{{ __('messages.apps') }} <span id="c_apps"></span>
      			</a>
      		</li>
					<li>
						<a class="vlink" href="{{ route('pages.show_created') }}">
          		{{ __('messages.pages') }} <span id="c_pages"></span>
      			</a>
      		</li>
					<li>
						<a class="vlink" href="{{ route('catalogs.show_created') }}">
          		{{ __('messages.catalogs') }} <span id="c_catalogs"></span>
      			</a>
					</li>
					<li>
						<a class="vlink" href="{{ route('posts.show_created') }}">
          		{{ __('messages.posts') }} <span id="c_posts"></span>
      			</a>
					</li>
				</ul>
			</li>
			<li style="font-weight:bold;">>{{ __('messages.subscriptions') }}
				<ul>
			  	<li>
						<a class="vlink" href="{{ route('subscriptions.show_apps') }}">
          		{{ __('messages.apps') }} <span id="c_apps_subscriptions"></span>
      			</a>
					</li>
					<li>
						<a class="vlink" href="{{ route('subscriptions.show_pages') }}">
          		{{ __('messages.pages') }} <span id="c_pages_subscriptions"></span>
      			</a>
					</li>
				</ul>
			</li>
		</ul>	
	</div>
</div>	

