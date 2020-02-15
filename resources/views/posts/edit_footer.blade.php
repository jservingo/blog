{{-- posts.edit_footer --}} 

@php
 include(app_path() . '/functions/box_options.php')
@endphp

@extends('layout_popup')

@section('content')
  <div class="grid-container">
    <div id="pageHeader">
      <h2>{{ $post->title }}</h2>
    </div>

    <div id="mainArticle">
      <div class="form-control">
			  <label><span>{{ __('messages.excerpt') }}:</span></label>
			  <textarea id="excerpt" 
				  placeholder="{{ __('messages.enter-excerpt') }}">{{ old('excerpt',$post->kpost->excerpt) }}</textarea>
			    {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
			</div>

			<div class="form-control">
        <label><span>{{ __('messages.observation') }}:</span></label>
        <textarea id="observation" 
          placeholder="{{ __('messages.enter-observation') }}">{{ old('observation',$post->kpost->observation) }}</textarea>
        {!! $errors->first('observation','<span class="help-block">:message</span>') !!}
      </div>

      <div class="form-control">
        <label><span>{{ __('messages.footnote') }}:</span></label>
        <input id="footnote" type="text" 
          value="{{ old('footnote',$post->kpost->footnote) }}"
          placeholder="{{ __('messages.enter-foootnote') }}">
        {!! $errors->first('footnote','<span class="help-block">:message</span>') !!}
      </div>  

      <div class="form-control">
        <label>
          <input type="checkbox" id="featured" 
            {!! $post->kpost->featured ? 'checked' : '' !!}>
          {{ $opc_featured }}
        </label>
      </div>

      {{--
      <div class="form-control">
        <a href="#" class="btn_update_post"
            data-id="{{ $post->id }}"
            data-type="{{ $post->type_id }}"
            Save changes
        </a>
      </div>
      --}}

      <div class="form-control">
        <a href="#" class="btn_update_post"
            data-id="{{ $post->id }}"
            data-type="{{ $post->type_id }}"
            data-kpost="{{ $post->kpost ? 1 : 0 }}">
            {{ __('messages.save-changes') }}
        </a>
      </div>

    </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_post_box.css">
  <link rel="stylesheet" href="/css/form_control.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
  <style>
  .grid-container { 
    height: auto;
    margin: 0;
  }  
  .grid-container > div {
    padding: 1.2em;
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
  <script type="text/javascript" src="/js/edit_footer.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
@endpush