{{-- posts.edit_post --}} 

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
				  placeholder="Enter the title of the post">
			  {!! $errors->first('title','<span class="help-block">:message</span>') !!}				
      </div>

      <div class="form-control">
			  <label><span>Excerpt:</span></label>
			  <textarea id="excerpt" 
				  placeholder="Enter an excerpt from the post">{{ old('excerpt',$post->excerpt) }}</textarea>
			    {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
			</div>

			<div class="form-control">
        <label><span>Content:</span></label>
      </div>
      <div>
			  <textarea id="body" 
				  placeholder="Enter the content of the post" rows="10"
			  >{{ old('body',$post->body)}}</textarea>
			  {!! $errors->first('body','<span class="help-block">:message</span>') !!}
      </div>

      @if($post->isWebPage())
      <div class="form-control">
        <label><span>Web Page url:</span></label>
			  <input id="url" type="text" 
				  value="{{ old('url',$post->url) }}"
				  placeholder="Ingrese el url">
			  {!! $errors->first('url','<span class="help-block">:message</span>') !!}
      </div>
			@endif       						

			@if($post->isFrame())
      <div class="form-control">
			  <label><span>iframe (Audio and video):</span></label>
			  <textarea rows="2" id="iframe" 
				  placeholder="Enter the content of the post" rows="10"
			  >{{ old('iframe',$post->iframe)}}</textarea>
			  {!! $errors->first('iframe','<span class="help-block">:message</span>') !!}
			</div>
			@endif

      @if ($post->kpost)
      <div class="form-control">
        <label><span>Observation:</span></label>
        <textarea id="observation" 
          placeholder="Enter an observation">{{ old('observation',$post->kpost->observation) }}</textarea>
        {!! $errors->first('observation','<span class="help-block">:message</span>') !!}
      </div>

      <div class="form-control">
        <label><span>Footnote:</span></label>
        <input id="footnote" type="text" 
          value="{{ old('footnote',$post->footnote) }}"
          placeholder="Enter the footnote">
        {!! $errors->first('footnote','<span class="help-block">:message</span>') !!}
      </div>  
      @endif	        
    </div>

    <div id="siteAds">
      <div class="form-control">
        <label><span>Publication date:</span></label>
        <input type="text" id="published_at" 
          class="pull-right" 
          value="{{ old('published_at',$post->published_at ? $post->published_at->format('m/d/Y') : null) }}"
          id="datepicker">
      </div>
      
      <div class="form-control">
        <label><span>Tags:</span></label>
        <textarea id="tags" 
          placeholder="Enter tags separated by a comma','">{{ old('tags',$post->strTags()) }}</textarea>
          {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
      </div> 

      <div class="form-control">
        <label><span>Options</span></label>
      </div>

      <div class="form-control">
        <label>Rating mode: </label>
          <select id='rating_mode'>
            <option value='2'>Likes</option>
            <option value='1'>Stars</option>            
            <option value='3'>Likes & dislikes</option>
            <option value='4'>No rating</option>
          </select>     
      </div>

      @if ($post->kpost)
      <div class="form-control">
        <label>
          <input type="checkbox" id="featured" 
            {!! $post->kpost->featured ? 'checked' : '' !!}>
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
          Any user can comment.
        </label>
      </div>

      @if($post->isCatalog())
      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_colaborative" 
            {!! $post->cstr_colaborative ? 'checked' : '' !!}>
          Any user can add posts to the catalog.
        </label>
      </div>
      @endif

      @if($post->isPage())
      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_colaborative" 
            {!! $post->cstr_colaborative ? 'checked' : '' !!}>
          Any user can add catalogs to the page.
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_allow_subscribers" 
            {!! $cstr_allow_subscribers ? 'checked' : '' !!}>
          Allow subscriptions. 
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_show_subscribers" 
            {!! $cstr_show_subscribers ? 'checked' : '' !!}>
          Show subscribers. 
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_main_page" 
            {!! $cstr_main_page ? 'checked' : '' !!}>
          Main page. 
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
        <label><span>Upload images</span></label>
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
            Save changes
        </a>
      </div>

      <div class="form-control">
        <a href="#" class="btn_cancel_edit">
            Cancel
        </a>
      </div>

      @if($post->isPhotoGallery())
    	  <p>Saved images</p>
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
    var excerpt = " "; 
    excerpt = $('#excerpt').val();
    var body = " ";
    body = CKEDITOR.instances.body.getData();
    var url = "";
    if (type=="Web page")
      url = $('#url').val();
    var iframe = "";
    if (type=="Frame")
      iframe = $('#iframe').val();
    var observation = $('#observation').val();
    var footnote = $('#footnote').val();
    var featured = get_value('#featured');
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
          set_message("notice","{{ $msg_update }}");
          //$.growl.notice({ message:"{{ $msg_update }}"});
          window.close();
        }
        else {
          set_message("error","Sorry but the update was not possible. Try again, please");
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
      dictDefaultMessage: 'Drag the photos here to upload'
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

  $('.btn_cancel_edit').bind('click', function(e){
  });

  function get_value(s)
  {
    if ($(s).is(':checked'))
      return(1);
    return(0);
  }

  function set_message(type, message)
  {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var data = {type:type, message:message};
    $.ajax({
      type: 'post',
      url: '/message',
      data: data,
      dataType: 'json',
      success: function(data) {
        //alert("set_message OK");
      },
      error: function (data) {
        console.log('Error:', data);
        //alert("set_message ERROR. Ver consola");
      }
    }); 
  }

  </script>
@endpush
