<div style="background-color:#7FB3D5; color:white; font-size:18px;">
  <div style='height:33px;'>
    <div style='float:right;'>
      <button onclick='btn_kpub_next()'>></button>
    </div>
    <div style='float:right;'>
      &nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <div style='float:right;'>
      <button onclick='btn_kpub_prev()'><</button>
    </div>
  </div>
  @php
    $file = asset("storage/posts/".$post->id.".inc");
    echo file_get_contents($file); 
  @endphp
</div>  