<?php
function htmlEntitiesWithinPres($code) {
  $offset = 0;
  $preStart = 0;
  while (is_numeric($preStart)) {
    $preStart = stripos($code, '<pre', $offset);
      if ($preStart === false):
        break;
      endif;
      $tagEnd = stripos($code, ">", $preStart);
      $preEnd = stripos($code, '</pre>', $preStart);
      $code = substr($code, 0, ($tagEnd + 1)) . htmlentities(substr($code, ($tagEnd + 1), ($preEnd - ($tagEnd + 1)))) . substr($code, $preEnd);
      $offset = ($preEnd + 6);
    }
  return $code;
}    
?>
