@extends('admin.layout')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
      		<h3 class="box-title">Datos personales</h3>
      	</div>
				<div class="box-body">
					@if ($errors->any())
						<ul class="list-group">
							@foreach ($errors->all() as $error)
								<li class="list-group-item list-group-item-danger">
									{{ $error }}
								</li>
							@endforeach
						</ul>
					@endif
					<form method="POST" action="{{ route('admin.users.store') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="name">Nombre</label>
							<input name="name" value="{{ old('name') }}" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input name="email" value="{{ old('email') }}" class="form-control">
						</div>
						{{-- 
						<div class="form-group">
							<label for="password">Contraseña</label>
							<input type="password" name="password" class="form-control" placeholder="Contraseña">
							<span class="help-block">Dejar en blaco para no cambiar la contraseña</span>
						</div>
						<div class="form-group">
							<label for="password_confirmation">Confirmar contraseña</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Repita la contraseña">
						</div>
						--}}
						<div class="form-group col-md-6">
							<label>Roles</label>
							@foreach($roles as $id => $name)
		      			<div class="checkbox">
		      				<label>
		      					<input type="checkbox" name="roles[]" value="{{ $name }}" 
		      						{{ $user->roles->contains($id) ? 'checked' : '' }}>
		      					{{ $name }}
		      				</label>
		      			</div>
	      			@endforeach
						</div>
						<div class="form-group col-md-6">
							<label>Permisos</label>
							@foreach($permissions as $id => $name)
		      			<div class="checkbox">
		      				<label>
		      					<input type="checkbox" name="permissions[]" value="{{ $name }}" 
		      						{{ $user->permissions->contains($id) ? 'checked' : '' }}>
		      					{{ $name }}
		      				</label>
		      			</div>
	      			@endforeach
						</div>
						<button class="btn btn-primary btn-block">Create user</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

