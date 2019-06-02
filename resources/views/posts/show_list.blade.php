{{-- posts.show_list --}} 

@extends('layout')

@section('content')
  <div style="overflow: hidden; width:100%">
    
    <div class="loader" style="float:left;"></div>

    <div id="main_panel" style="visibility:hidden;">
      @include('posts.title')
      @include('pages.subtitle')

      <div id="posts_container" class="posts container">
        @php ($zcolor="#fefdfd")
        @foreach($posts as $post)
          <div>
            @include('posts.list.view')    
          </div>
          @if ($zcolor=="#fefdfd")
            @php ($zcolor="#cee3ea")
          @else
            @php ($zcolor="#fefdfd")
          @endif
        @endforeach
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
  <link rel="stylesheet" href="/css/framework_list.css">
  <link rel="stylesheet" href="/css/multiselect.css">
@endpush

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
  <script type="text/javascript" src="/js/confirmDialog.min.js"></script>
  <script type="text/javascript" src="/js/growl.js"></script>
  <script type="text/javascript" src="/js/buttons_add_save_discard.js"></script>
  <script type="text/javascript" src="/js/buttons_catalog_ribbon.js"></script>
  <script type="text/javascript" src="/js/buttons_copy_paste.js"></script>
  <script type="text/javascript" src="/js/buttons_create_edit_show.js"></script>
  <script type="text/javascript" src="/js/buttons_delete.js"></script>
  <script type="text/javascript" src="/js/buttons_header.js"></script>
  <script type="text/javascript" src="/js/multiselect.js"></script>
  <script type="text/javascript" src="/js/popr.js"></script>
  <script type="text/javascript" src="/js/truncate.js"></script>
  <script type="text/javascript" src="/js/menu_header.js"></script>
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
    var iframe_width = 174;
  </script>
  <script type="text/javascript" src="/js/resize_iframe_resize.js"></script>
  <script>
    @if ($root=="contacts")
      var reset_contacts_tree = true;
    @else
      var reset_contacts_tree = false; 
    @endif
  </script>   
  @if ($root=="contacts" || $root=="contacts_group")
    <script type="text/javascript" src="/js/contactsTree.js"></script>     
  @endif  
  @if ($root=="page_catalogs_posts")
    <script>
      var page_id = {{ $page->id }};
      @if ($reset_categories_tree)
        var reset_categories_tree = true;
      @else
        var reset_categories_tree = false; 
      @endif
    </script>
    <script type="text/javascript" src="/js/categoriesTree.js"></script>
  @endif  
  @if ($root=="page_catalogs_posts")
    <script>
      var page_id = {{ $page->id }};
      @if ($reset_categories_tree)
        var reset_categories_tree = true;
      @else
        var reset_categories_tree = false; 
      @endif
    </script>
    <script type="text/javascript" src="/js/categoriesTree.js"></script>
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
    var width_container = $(window).width() * 0.90; //-380 
    $(".container").width(width_container);
    $(".post").each(function() {
      var width_post = width_container; //-60
      var width_header = $(this).find(".header").width();
      var width_media = $(this).find(".media").width();
      var width_content = width_post - width_header - width_media - 20;
      var width_footnote = width_post - 260;
      $(this).width(width_post);
      $(this).find(".content").width(width_content);
      $(this).find(".footnote").width(width_footnote);
    });
    
    $(window).resize(function () {
      var width_container = $(window).width() * 0.90 //-380; 
      $(".container").width(width_container);      
      $(".post").each(function() {
        var width_post = width_container; //-60
        var width_header = $(this).find(".header").width();
        var width_media = $(this).find(".media").width();
        var width_content = width_post - width_header - width_media - 20;
        var width_footnote = width_post - 260;
        $(this).width(width_post);
        $(this).find(".content").width(width_content);
        $(this).find(".footnote").width(width_footnote);
      });
    });
  </script>
  <script>
    $(function() {
      $(".loader").fadeOut("slow");
      $('#main_panel').css("visibility","visible");
    });
  </script>
@endpush