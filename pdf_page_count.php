<?php 
$path = '3.pdf';
$totalPages = check($path);
    
echo $totalPages;
    
function check($path) {
  $pdf = file_get_contents($path);
  $number = preg_match_all("/\/Page\W/", $pdf, $dummy);
  return $number;
}  
?>
