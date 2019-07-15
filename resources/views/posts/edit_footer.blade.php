{{-- posts.edit_footer --}} 

@php
 include(app_path() . '/functions/box_options.php')
@endphp

@extends('layout_popup')

@section('content')
  <div class="grid-container">
    <div id="pageHeader">
      <h2>Edit {{ $post->type->name }}</h2>
    </div>

    <div id="mainArticle">
    	<div class="form-control">
        <label><span>{{ $title }}</span></label>
			  <input id="title" type="text"  
				  value="{{ old('title',$post->title) }}"
				  placeholder="Ingrese el título del aviso">
			  {!! $errors->first('title','<span class="help-block">:message</span>') !!}				
      </div>

      <div class="form-control">
			  <label><span>Extracto:</span></label>
			  <textarea id="excerpt" 
				  placeholder="Ingresa un extracto del post">{{ old('excerpt',$post->excerpt) }}</textarea>
			    {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
			</div>

			<div class="form-control">
        <label><span>Contenido</span></label>
      </div>
      <div>
			  <textarea id="body" 
				  placeholder="Ingresa el contenido del post" rows="10"
			  >{{ old('body',$post->body)}}</textarea>
			  {!! $errors->first('body','<span class="help-block">:message</span>') !!}
      </div>

      @if($post->isWebPage())
      <div class="form-control">
        <label><span>Web Page url</span></label>
			  <input id="url" type="text" 
				  value="{{ old('url',$post->url) }}"
				  placeholder="Ingrese el url">
			  {!! $errors->first('url','<span class="help-block">:message</span>') !!}
      </div>
			@endif       						

			@if($post->isFrame())
      <div class="form-control">
			  <label><span>Audio y Video (iframe)</span></label>
			  <textarea rows="2" id="iframe" 
				  placeholder="Ingresa el contenido del aviso" rows="10"
			  >{{ old('iframe',$post->iframe)}}</textarea>
			  {!! $errors->first('iframe','<span class="help-block">:message</span>') !!}
			</div>
			@endif

      @if ($post->kpost)
      <div class="form-control">
        <label><span>Observation:</span></label>
        <textarea id="observation" 
          placeholder="Ingresa una observación">{{ old('observation',$post->observation) }}</textarea>
        {!! $errors->first('observation','<span class="help-block">:message</span>') !!}
      </div>

      <div class="form-control">
        <label><span>Footnote</span></label>
        <input id="footnote" type="text" 
          value="{{ old('footnote',$post->footnotee) }}"
          placeholder="Ingrese el footnote">
        {!! $errors->first('footnote','<span class="help-block">:message</span>') !!}
      </div>  
      @endif	        
    </div>

    <div id="siteAds">
      <div class="form-control">
        <label><span>Fecha de publicación:</span></label>
        <input type="text" id="published_at" 
          class="pull-right" 
          value="{{ old('published_at',$post->published_at ? $post->published_at->format('m/d/Y') : null) }}"
          id="datepicker">
      </div>
      
      <div class="form-control">
        <label><span>Tags:</span></label>
        <textarea id="tags" 
          placeholder="Ingresa las etiquetas separadas por una coma ','">{{ old('tags',$post->strTags()) }}</textarea>
          {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
      </div> 

      <div class="form-control">
        <label><span>Opciones</span></label>
      </div>

      <div class="form-control">
        <label>Rating mode: </label>
          <select id='rating_mode'>
            <option value='1'>Stars</option>
            <option value='2'>Likes</option>
            <option value='3'>Likes & dislikes</option>
            <option value='4'>No rating</option>
          </select>     
      </div>

      @if ($post->kpost)
      <div class="form-control">
        <label>
          <input type="checkbox" id="featured" 
            {!! $post->featured ? 'checked' : '' !!}>
          {{ $opc_featured }}
        </label>
      </div>
      @endif

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_privacy" 
            {!! $post->cstr_privacy ? 'checked' : '' !!}>
          {{ $opc_privacy }}
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_restricted" 
            {!! $post->cstr_restricted ? 'checked' : '' !!}>
          {{ $opc_restricted }}
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_allow_comments" 
            {!! $post->cstr_allow_comments ? 'checked' : '' !!}>
          Cualquier usuario puede realizar comentarios.
        </label>
      </div>

      @if($post->isCatalog())
      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_colaborative" 
            {!! $post->cstr_colaborative ? 'checked' : '' !!}>
          Cualquier usuario agregar posts al catálogo.
        </label>
      </div>
      @endif

      @if($post->isPage())
      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_colaborative" 
            {!! $post->cstr_colaborative ? 'checked' : '' !!}>
          Cualquier usuario agregar catálogos a la página.
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_allow_subscribers" 
            {!! $cstr_allow_subscribers ? 'checked' : '' !!}>
          Permitir subscriptores. 
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_show_subscribers" 
            {!! $cstr_show_subscribers ? 'checked' : '' !!}>
          Mostrar subscriptores. 
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_main_page" 
            {!! $cstr_main_page ? 'checked' : '' !!}>
          Página principal. 
        </label>
      </div>
      @endif
      
      {{-- 
        posts 
          rating_mode, allow_comments, send_massive
        kposts, pages 
          featured
        posts, pages, catalogs  
          privacy, restricted, colaborative
        pages   
          allow_subscribers, show_subscribers, main_page
      --}}

      @if($post->isPhotoGallery())
      <div class="form-control">
        <label><span>Subir imágenes</span></label>
      </div>
      <div class="dropzone"></div>
      @endif 
    </div>    

    <div id="pageFooter">
      <div class="form-control">
        <a href="#" class="btn_update_post"
            data-id="{{ $post->id }}"
            data-type="{{ $post->type_id }}"
            data-kpost="{{ $post->kpost ? 1 : 0 }}">
            Guardar
        </a>
      </div>

      @if($post->isPhotoGallery())
    	  <p>Aqui van las imagenes guardadas</p>
    	  <br>
        @if ($post->photos->count())		
  			  <div class="row"> 
            @foreach ($post->photos as $photo) 
              <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}"> 
                {{ method_field('DELETE') }} {{ csrf_field() }} 
                <div style="width:18%"> 
                  {{--
                  <a href="#" style="position: absolute">
                    <img src="/img/delete2.png" width="20" />
                  </a>
                  --}}
                  <input type="submit" value="x" style="background:url(/img/delete2.png) no-repeat;" />
                  <img class="img-responsive" src="{{ url('storage/'.$photo->url) }}"> 
                </div>
              </form> 
            @endforeach 
          </div> 
  		  @endif
      @endif
	  </div>
  </div>	
   	
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_post_box.css">
  <link rel="stylesheet" href="/css/form_control.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
<style>
.grid-container { 
  display: grid;
  grid-template-areas: 
    "header header"
    "main ads"
    "footer footer";
  grid-template-rows: 50px auto auto;  
  grid-template-columns: 3fr 2fr;
  grid-row-gap: 10px;
  grid-column-gap: 10px;
  height: auto;
  margin: 0;
}  
.grid-container > div {
  padding: 1.2em;
}
#pageHeader {
  grid-area: header;
}
#pageFooter {
  grid-area: footer;
}
#mainArticle { 
  grid-area: main;      
}
#mainNav { 
  grid-area: menu; 
  background: #e6f2ff;
  padding-left: 20px;
}
#siteAds { 
  grid-area: ads; 
} 
/* Stack the layout on small devices/viewports. */
@media all and (max-width: 575px) {
  .grid-container { 
    grid-template-areas:
      "header" 
      "main"
      "ads"
      "menu"
      "footer";
    grid-template-rows: 70px 1fr 70px 1fr 70px;  
    grid-template-columns: 1fr;
  }
}
</style>
@endpush

@push('scripts')
  <script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>  
  <script type="text/javascript" src="/js/growl.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <!-- <script src="/adminlte/plugins/select2/select2.full.min.js"></script> -->
  <!-- <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script> -->

  <script>
  //Date picker
  /*
  $('#datepicker').datepicker({
    autoclose: true
  });

  //Initialize Select2 Elements
  $(".select2").select2();
  */

  $('.btn_update_post').bind('click', function(e){
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var post_id = $(this).data("id");
    var type_id = $(this).data("type");
    var kpost = $(this).data("kpost");    
    var type = get_type(type_id);
    var title = $('#title').val();
    var excerpt = $('#excerpt').val();
    var body = CKEDITOR.instances.body.getData();
    var url = "";
    if (type=="Web page")
      url = $('#url').val();
    var iframe = "";
    if (type=="Frame")
      iframe = $('#iframe').val();
    var observation = "";
    var footnote = "";
    var featured = 0;
    if (kpost==1)
    {
      observation = $('#observation').val();
      footnote = $('#footnote').val();
      featured = get_value('#featured');
    }
    var published_at = $('#published_at').val();
    var tags = $('#tags').val();
    var rating_mode = $('#rating_mode').val();
    var cstr_privacy = get_value('#cstr_privacy');
    var cstr_restricted = get_value('#cstr_restricted');
    var cstr_allow_comments = get_value('#cstr_allow_comments');
    var cstr_colaborative = 0;
    if (type=="Catalog" || type=="Page")
      cstr_colaborative = get_value('#cstr_colaborative');
    var cstr_allow_subscribers = 0;
    var cstr_show_subscribers = 0;
    var cstr_main_page = 0;
    if (type=="Page")
    {
      cstr_allow_subscribers = get_value('#cstr_allow_subscribers');
      cstr_show_subscribers = get_value('#cstr_show_subscribers');
      cstr_main_page = get_value('#cstr_main_page');
    }
    var data = {
      post_id: post_id,
      type_id: type_id,
      kpost: kpost,
      title: title,
      excerpt: excerpt,
      body: body,
      url: url,
      iframe: iframe,
      observation: observation,
      footnote: footnote,
      published_at: published_at,
      tags: tags,
      rating_mode: rating_mode,
      featured: featured,
      cstr_privacy: cstr_privacy,
      cstr_restricted: cstr_restricted,
      cstr_allow_comments: cstr_allow_comments,
      cstr_colaborative: cstr_colaborative,
      cstr_allow_subscribers: cstr_allow_subscribers,
      cstr_show_subscribers: cstr_show_subscribers,
      cstr_main_page: cstr_main_page
    };
    $.ajax({
      type: 'put',
      url: '/post/'+post_id,
      data: data,
      dataType: 'json',
      success: function(data) {
        if (data.success){
          $.growl.notice({ message:"{{ $msg_update }}"});
        }
        else {
          set_message("error","Lo sentimos pero no fue posible realizar la actualización. Intente de nuevo");
          location.reload();
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    }); 
  });

  CKEDITOR.replace('body');

  CKEDITOR.config.height = 220;

  if($('.dropzone').length)
  {     
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

    myDropzone.on("addedfile", function(file) {
      console.log(file);
      //alert("Ver consola");
    });

    myDropzone.on('error', function(file, res) {
      var msg = res.errors.photo[0];
      $('.dz-error-message:last > span').text(msg);
    });
  }

  function get_value(s)
  {
    if ($(s).is(':checked'))
      return(1);
    return(0);
  }

  </script>
@endpush