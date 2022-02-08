<?php
$key="abc@gmail.com";
$storeMe = bin2hex($key);
echo $storeMe;
echo "<br>";
$msg = hex2bin($storeMe);
echo $msg;
?>
