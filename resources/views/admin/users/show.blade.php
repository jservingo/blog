@extends('admin.layout')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" 
          	src="/adminlte/img/user4-128x128.jpg" 
          	alt="{{ $user->name }}">

          <h3 class="profile-username text-center">{{ $user->name }}</h3>

          <p class="text-muted text-center">{{ $user->getRoleNames()->implode(', ') }}</p>

          <ul class="list-group list-group-unbordered">
          	@if ($user->pages->count())
          		<li class="list-group-item">
              	<b>Pages</b> <a class="pull-right">{{ $user->pages->count() }}</a>
            	</li>
            @endif
            @if ($user->catalogs->count())
            	<li class="list-group-item">
              	<b>Catalogs</b> <a class="pull-right">{{ $user->catalogs->count() }}</a>
            	</li>
            @endif
            @if ($user->subscriptions->count())
            	<li class="list-group-item">
              	<b>Subscriptions</b> <a class="pull-right">{{ $user->subscriptions->count() }}</a>
            	</li>
            @endif
          </ul>

          <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a>
        </div>
        <!-- /.box-body -->
      </div>		
		</div>	
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Pages</h3>
					<div class="box-body">
						@forelse ($user->pages as $page)
						  <a href="{{ route('page.show_page',$page) }}" target="_blank">
								<strong>{{ $page->name }}</strong>
							</a>
							<br>
							<small class="text-muted">Created {{ $page->created_at->format('d/M/Y') }}</small>
							<p class="text-muted">Subscribers: {{ $page->subscribers->count() }}</p>
							@unless ($loop->last)
								<hr>
							@endunless
						@empty
							<small class="text-muted">No ha creado páginas</small>
						@endforelse
					</div>
				</div>
			</div>		
		</div>	
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Subscriptions</h3>
					<div class="box-body">
						@forelse ($user->subscriptions as $page)
						  <a href="{{ route('page.show_page',$page) }}" target="_blank">
								<strong>{{ $page->name }}</strong>
							</a>
							<br>
							<small class="text-muted">Created {{ $page->created_at->format('d/M/Y') }}</small>
							<p class="text-muted">Subscribers: {{ $page->subscribers->count() }}</p>
							@unless ($loop->last)
								<hr>
							@endunless
						@empty
							<small class="text-muted">No tiene subscripciones</small>
						@endforelse
					</div>
				</div>
			</div>		
		
		</div>	
		<div class="col-md-3">
			Otros Permisos
		
		</div>		
	</div>

@endsection