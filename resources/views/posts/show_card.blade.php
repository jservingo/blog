{{-- posts.show_card --}} 

@extends('layout')

@section('content')
  <div style="overflow: hidden; width:100%">

    <div class="loader"></div>

    @include('home.menu_categories')

    <div id="main_panel" style="visibility:hidden;">
      @include('posts.title')
      @include('pages.subtitle')

      <div id="posts_container" class="posts container">
        @if(!$posts->isEmpty())
          @foreach($posts as $post)
            <div>
              @include('posts.card.view')    
            </div>
          @endforeach
        @else
          @include('posts.show_message')
        @endif
      </div>

      {{ $posts->render("pagination::default") }}
      {{-- $posts->links() --}}
    </div>
  </div> 

  <div>
    @foreach($posts as $post)
      @include('posts.buttons.box_popup_menu')    
    @endforeach      
  </div>   
@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_card.css">
  <link rel="stylesheet" href="/css/multiselect.css">
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>
  @php
    include(app_path() . '/functions/messages_js.blade.php')
  @endphp
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons/add_save_discard.js"></script>
  <script type="text/javascript" src="/js/buttons/catalog_ribbon.js"></script>
  <script type="text/javascript" src="/js/buttons/copy_paste.js"></script>
  <script type="text/javascript" src="/js/buttons/create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons/delete.js"></script>
  <script type="text/javascript" src="/js/buttons/header.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="/js/multiselect.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/truncate.js"></script>
  <script type="text/javascript" src="/js/jqsimplemenu.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('.menu').jqsimplemenu();
    });
  </script>
  <script>
    $(document).ready(function() {
     $('.popr').popr();
    });
  </script>  
  <script>
    var iframe_width = 77;
  </script>
  <script type="text/javascript" src="/js/resize_iframe.js"></script>
  <script>
    @if ($root=="contacts")
      var reset_contacts_tree = true;
    @else
      var reset_contacts_tree = false; 
    @endif
  </script>   
  @if ($root=="contacts" || $root=="contacts_group")
    <script type="text/javascript" src="/js/contactsTree.js"></script> 
    <script type="text/javascript" src="/js/buttons/categories.js"></script>    
  @endif  
  @if ($root=="app_subs" || $root=="app_pages")
    <script> 
      var rv_type_id = 23; 
      var rv_post_id = 0;
      var rv_ref_id = {{ $app->id }};
    </script> 
    <script type="text/javascript" src="/js/saveCookieRecentViews.js"></script>
  @endif  
  @if ($root=="page_category")
    <script>
      var page_id = {{ $page->id }};
      @if ($reset_categories_tree)
        var reset_categories_tree = true;
      @else
        var reset_categories_tree = false; 
      @endif
      var rv_type_id = 22; 
      var rv_post_id = 0;
      var rv_ref_id = page_id;
    </script>
    <script type="text/javascript" src="/js/categoriesTree.js"></script>
    <script type="text/javascript" src="/js/buttons/categories.js"></script>
    <script type="text/javascript" src="/js/saveCookieRecentViews.js"></script>
  @endif    
  @if ($root=="catalog")
    <script> 
      var rv_type_id = 21; 
      var rv_post_id = 0;
      var rv_ref_id = {{ $ref_id }};
    </script> 
    <script type="text/javascript" src="/js/saveCookieRecentViews.js"></script>
  @endif  
  @include('home.message')
  <script>
    var url_current = "{{ url()->current() }}";
  </script>
  <script type="text/javascript" src="/js/searchButton.js"></script>
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush