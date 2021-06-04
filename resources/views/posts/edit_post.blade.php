{{-- posts.edit_post --}} 

@php
 include(app_path() . '/functions/box_options.php')
@endphp

@extends('layout_popup')

@section('content')
  <div class="main-container">
    <div class="wide-container">
      <div class="pageHeader">
        <h2>{{ __('messages.edit') }} {{ $post->get_type() }}</h2>
      </div>
    </div>
    
    <div class="left-container">  
    	<div class="form-control">
        <label><span>{{ $title }}: (*) {{ __('messages.required-field') }} </span></label>
			  <input id="title" type="text"  
				  value="{{ old('title',$post->title) }}"
				  placeholder="{{ __('messages.enter-title') }}">
			  {!! $errors->first('title','<span class="help-block">:message</span>') !!}
      </div>

      <div class="form-control">
			  <label><span>{{ __('messages.excerpt') }}: (*) {{ __('messages.required-field') }}</span></label>
			  <textarea id="excerpt" 
				  placeholder="{{ __('messages.enter-excerpt') }}">{{ old('excerpt',$post->excerpt) }}</textarea>
			    {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
			</div>

			<div class="form-control">
        <label><span>{{ __('messages.content') }}: (*) {{ __('messages.required-field') }}</span></label>
			  <textarea id="body" style="width:90%"
				  placeholder="{{ __('messages.enter-content') }}" rows="12"
			  >{{ old('body',$post->body)}}</textarea>
			  {!! $errors->first('body','<span class="help-block">:message</span>') !!}
      </div>

      @if($post->isWebPage())
      <div class="form-control">
        <label><span>{{ __('messages.web-page-url') }}:</span></label>
			  <input id="url" type="text" 
				  value="{{ old('url',$post->url) }}"
				  placeholder="{{ __('messages.enter-web-page-url') }}">
			  {!! $errors->first('url','<span class="help-block">:message</span>') !!}
      </div>
			@endif       						

			@if($post->isFrame())
      <div class="form-control">
			  <label><span>{{ __('messages.frame') }}:</span></label>
			  <textarea rows="2" id="iframe" 
				  placeholder="{{ __('messages.enter-frame') }}" rows="10"
			  >{{ old('iframe',$post->iframe)}}</textarea>
			  {!! $errors->first('iframe','<span class="help-block">:message</span>') !!}
			</div>
			@endif

      @if ($post->kpost)
      <div class="form-control">
        <label><span>{{ __('messages.observation') }}:</span></label>
        <textarea id="observation" 
          placeholder="{{ __('messages.enter-observation') }}">{{ old('observation',$post->kpost->observation) }}</textarea>
        {!! $errors->first('observation','<span class="help-block">:message</span>') !!}
      </div>

      <div class="form-control">
        <label><span>{{ __('messages.footnote') }}:</span></label>
        <input id="footnote" type="text" 
          value="{{ old('footnote',$post->footnote) }}"
          placeholder="{{ __('messages.enter-footnote') }}">
        {!! $errors->first('footnote','<span class="help-block">:message</span>') !!}
      </div>  
      @endif	        
    </div>

    <div class="right-container">
      <div class="form-control">
        <label><span>{{ __('messages.publication-date') }}:</span></label>
        <input type="text" id="published_at" 
          class="pull-right" 
          value="{{ old('published_at',$post->published_at ? $post->published_at->format('m/d/Y H:i:s') : null) }}"
          id="datepicker">
      </div>
      
      <div class="form-control">
        <label><span>{{ __('messages.tags') }}:</span></label>
        <textarea id="tags" 
          placeholder="{{ __('messages.enter-tags') }}">{{ old('tags',$post->strTags()) }}</textarea>
          {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
      </div> 

      <div class="form-control">
        <label><span>{{ __('messages.options') }}:</span></label>
      </div>

      <div class="form-control">
        <label>{{ __('messages.rating-mode') }}: </label>
          <select id='rating_mode'>
            <option value='2'>{{ __('messages.likes') }}</option>
            <option value='1'>{{ __('messages.stars') }}</option>            
            <option value='3'>{{ __('messages.likes-dislikes') }}</option>
            <option value='4'>{{ __('messages.no-rating') }}</option>
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

      <div class="form-control">
        <label>
          <input type="checkbox" id="hide" 
            {!! $post->kpost->hide ? 'checked' : '' !!}>
          {{ __('messages.hide-post') }}
        </label>
      </div>

      <div class="form-control">
        <label>{{ __('messages.order-num') }}: </label>
          <input type="number" id="order_num" min="0"
            style = "width: 50px;" step="1" 
            value="{{ old('order_num',$post->kpost->order_num) }}">
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
          {{ __('messages.add-comments') }}
        </label>
      </div>

      @if($post->isCatalog())
      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_colaborative" 
            {!! $post->cstr_colaborative ? 'checked' : '' !!}>
          {{ __('messages.add-posts') }}
        </label>
      </div>
      @endif

      @if($post->isPage())
      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_colaborative" 
            {!! $post->cstr_colaborative ? 'checked' : '' !!}>
          {{ __('messages.add-catalogs') }}
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_allow_subscribers" 
            {!! $cstr_allow_subscribers ? 'checked' : '' !!}>
          {{ __('messages.subscribe-page') }} 
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_show_subscribers" 
            {!! $cstr_show_subscribers ? 'checked' : '' !!}>
          {{ __('messages.show-subscribers') }} 
        </label>
      </div>

      <div class="form-control">
        <label>
          <input type="checkbox" id="cstr_main_page" 
            {!! $cstr_main_page ? 'checked' : '' !!}>
          {{ __('messages.main-page') }} 
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
    </div>

    <div class="wide-container">
      <div id="confirm_actions">
        <button id="confirm_doit" class="btn_update_post red"
          data-id="{{ $post->id }}"
          data-type="{{ $post->type_id }}"
          data-kpost="{{ $post->kpost ? 1 : 0 }}">
          {{ __('messages.save-changes') }}
        </button>
        <button id="confirm_dont" class="btn_cancel_edit gray">
          {{ __('messages.cancel') }}
        </button>
      </div>
    </div>

    @if($post->isPhotoGallery() || $post->isOffer() || $post->isUser())
      <div class="half-container">  
        <div class="form-control">
          <label><span>{{ __('messages.upload-images') }}</span></label>
          <div class="dropzone"></div>       
        </div>
      </div>
    @endif

    @if($post->isPhotoGallery() || $post->isFrame() || $post->isText() || $post->isNotification() || $post->isWebPage() || $post->isAlert()|| $post->isOffer() || $post->isCustom() || $post->isMessage())
      <div class="half-container" id="">
        <div class="form-control">
          <label><span>{{ __('messages.upload-audios') }}</span></label>
          @include('posts.edit_audio')
        </div>
      </div>    
    @endif

    @if($post->isPhotoGallery() || $post->isOffer())
      <div class="wide-container">        
    	  <p>{{ __('messages.saved-images') }}</p>
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
                  <img class="img-responsive" src="{{ url('storage/'.$photo->url) }}" width="400"> 
                </div>
              </form> 
            @endforeach 
          </div> 
  		  @endif      
	   </div>
    @endif
    <div class="wide-container">
      <br>
    </div>
  </div>	
   	
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_post_box.css?ver=1.11">
  <link rel="stylesheet" href="/css/form_control.css">
  <link rel="stylesheet" href="/css/easyui.css">
  <link rel="stylesheet" href="/css/icon.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
  <style>
  .main-container { 
    height: auto;
  } 
  .wide-container {
    float:left;
    padding: 0px 1.2em;
    width:100%;
  } 
  .half-container {
    float:left;
    padding: 0px 1.2em;
    width:50%;
  }
  .left-container {
    float:left;
    padding: 0px 1.2em;
    width:64%;
  }
  .right-container {
    float:left;
    padding: 0px 1.2em;
    width:36%;
  }
  .fitem {
    padding: 10px 0px;
  }
  @media all and (max-width: 768px) {
    .left-container { 
      width:100%;
    }
    .right-container { 
      width:100%;
    }
    .half-container { 
      width:100%;
    }
  }
  </style>
@endpush

@push('scripts')
  <script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>  
  <script type="text/javascript" src="/js/growl.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
  <script type="text/javascript" src="/js/easyui.min.js"></script>
  <script type="text/javascript" src="/js/edit_post.js"></script>
  <script type="text/javascript" src="/js/edit_audios.js?ver=1.35"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script>
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

      $(window).on('resize', function(){
        var w = $(window).width() / 2 - 100;
        $('#dg').datagrid('resize',{
            width: w 
        });  
      });

    }
  </script>

  <!-- <script src="/adminlte/plugins/select2/select2.full.min.js"></script> -->
  <!-- <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script> -->
@endpush
