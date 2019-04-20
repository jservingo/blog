@extends('admin.layout')

@section('header')
	<h1>
        Avisos
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Avisos</li>
    </ol>
@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Listado de Avisos</h3>
      <button class="btn btn-primary pull-right" 
                data-toggle="modal" 
                data-target="#exampleModal">
        <i class="fa fa-plus"></i>&nbsp;&nbsp;Crear Aviso
      </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="posts-table" class="table table-bordered table-striped">
        <thead>
	        <tr>
	          <th>Id</th>
	          <th>Título</th>
	          <th>Extracto</th>
	          <th>Acciones</th>
	        </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->excerpt }}</td>
              <td>
                <a href="{{ route('post.show',$post) }}" 
                    class="btn btn-xs btn-default"
                    target="_blank">
                    <i class="fa fa-eye"></i>
                </a>
              	<a href="{{ route('admin.posts.edit',$post) }}"	
                    class="btn btn-xs btn-info">
                    <i class="fa fa-pencil"></i>
                </a>
                <form method="POST" 
                      action="{{ route('admin.posts.destroy',$post) }}" 
                      style="display:inline">
                  {{ csrf_field() }} {{ method_field("DELETE") }}
                  <button class="btn btn-xs btn-danger">
                      <i class="fa fa-times"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@stop

@push('styles')
  <!-- Datatable -->
  <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush

@push('scripts')
	<!-- Datatable -->
	<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
	  $(function () {
	    $('#posts-table').DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });
	  });

</script> 
@endpush
