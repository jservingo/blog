<div style="background-color:#7FB3D5; color:white; font-size:18px;">
  <div style='height:50px;'>
    <div style='float:left;'>
      <span id="kpub_page"></span>
    </div>
    <div style='float:right;'>
      <button class='button-arrows' onclick='btn_kpub_next()'>
        &nbsp;&nbsp; > &nbsp;&nbsp;
      </button>
    </div>
    <div style='float:right;'>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <div style='float:right;'>
      <button class='button-arrows' onclick='btn_kpub_prev()'>
        &nbsp;&nbsp; < &nbsp;&nbsp;
      </button>
    </div>
  </div>
  @php
    $file = asset("storage/posts/".$post->id.".inc");
    echo file_get_contents($file); 
  @endphp
</div>  