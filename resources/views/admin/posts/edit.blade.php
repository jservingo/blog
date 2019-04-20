@extends('admin.layout')

@section('header')
	<h1>
    Avisos
    <small>Crear un nuevo aviso</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-dashboard"></i> Avisos</a></li>
    <li class="active">Crear</li>
  </ol>
@stop

@section('content')
    <div class="row">
    	<form method="post" action="{{ route('admin.posts.update',$post)}}">
    		{{ csrf_field() }} {{ method_field('PUT') }}
	    	<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							<label>Título del aviso</label>
							<input name="title" type="text" 
									class="form-control" 
									value="{{ old('title',$post->title) }}"
									placeholder="Ingrese el título del aviso">
							{!! $errors->first('title','<span class="help-block">:message</span>') !!}
						</div>						
						<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
							<label>Contenido</label>
							<textarea name="body" id="editor" class="form-control" 
									placeholder="Ingresa el contenido del aviso" rows="10"
									>{{ old('body',$post->body)}}</textarea>
							{!! $errors->first('body','<span class="help-block">:message</span>') !!}
						</div>
						<div class="form-group {{ $errors->has('iframe') ? 'has-error' : '' }}">
							<label>Audio y Video (iframe)</label>
							<textarea rows="2" name="iframe" id="editor" class="form-control" 
									placeholder="Ingresa el contenido del aviso" rows="10"
									>{{ old('iframe',$post->iframe)}}</textarea>
							{!! $errors->first('iframe','<span class="help-block">:message</span>') !!}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group">
                			<label>Fecha de publicación:</label>
                			<div class="input-group date">
                  				<div class="input-group-addon">
                    				<i class="fa fa-calendar"></i>
                  				</div>
                  				<input type="text" name="published_at" 
                  						class="form-control pull-right" 
                  						value="{{ old('published_at',$post->published_at ? $post->published_at->format('m/d/Y') : null) }}"
                  						id="datepicker">
                			</div>
                			<!-- /.input group -->
             			</div>
             			<div class="form-group {{ $errors->has('type_id') ? 'has-error' : '' }}">
                			<label>Tipo:</label>
                			<select name="type_id" class="form-control">
                				<option value="">Seleccione un tipo de aviso</option>
                				@foreach ($types as $type)
                					<option value="{{ $type->id}}"
                						{{ old('type_id',$post->type_id)==$type->id ? 'selected' : '' }}
                					>{{ $type->name }}</option>
                				@endforeach
                			</select>
                			{!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
                		</div>
                		<div class="form-group">
                			<label>Etiquetas:</label>
                			<select name="tags[]" 
                				class="form-control select2" 
                				multiple="multiple"
                				data-placeholder="Selecciona una o más etiquetas"
                				style="width:100%;">
                				@foreach ($tags as $tag)
                					<option
                						{{ collect(old('tags',$post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}
                						value="{{ $tag->id}}">{{ $tag->name }}
                					</option>
                				@endforeach	
                			</select>
                			{!! $errors->first('tags','<span class="help-block">:message</span>') !!}
                		</div>
						<div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
							<label>Extracto:</label>
							<textarea name="excerpt" class="form-control" 
								placeholder="Ingresa un extracto del aviso">{{ old('excerpt',$post->excerpt) }}</textarea>
							{!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
						</div>
						<div class="form-group">
							<div class="dropzone"></div>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Guardar aviso</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		@if ($post->photos->count())
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body"> 
						<div class="row"> 
							@foreach ($post->photos as $photo) 
								<form method="POST" action="{{ route('admin.photos.destroy', $photo) }}"> 
									{{ method_field('DELETE') }} {{ csrf_field() }} 
									<div class="col-md-2"> 
										<button class="btn btn-danger btn-xs" style="position: absolute">
											<i class="fa fa-remove"></i>
										</button> 
										<img class="img-responsive" src="{{ url('storage/'.$photo->url) }}"> 
									</div>
								</form> 
							@endforeach 
						</div> 
					</div> 
				</div>
			</div>
		@endif
	</div>
@stop

@push('styles')
  <!-- Dropzone -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
	<!-- Dropzone -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

	<!-- CK Editor -->
	<script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>

	<!-- Select2 -->
	<script src="/adminlte/plugins/select2/select2.full.min.js"></script>

	<!-- bootstrap datepicker -->
	<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>

    <script>
	    //Date picker
	    $('#datepicker').datepicker({
	      autoclose: true
	    });

	    //Initialize Select2 Elements
	    $(".select2").select2();

	    CKEDITOR.replace('editor');

	    CKEDITOR.config.height = 220;

	    var myDropzone = new Dropzone('.dropzone',{
	    	url: '/admin/posts/{{ $post->id }}/photos',
	    	headers: {
	    		'X-CSRF-TOKEN': '{{ csrf_token() }}'
	    	},
	    	acceptedFiles: 'image/*',
	    	paramName: 'photo',
	    	maxFileSize: 2,
	    	maxFiles:8,
	    	dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
	    });

	    Dropzone.autoDiscover = false;

	    myDropzone.on('error', function(file, res) {
	    	var msg = res.errors.photo[0];
	    	$('.dz-error-message:last > span').text(msg);
	    });

	</script>
@endpush
