<?php
$odesilatel = $_POST['PackFileName'];
unlink($odesilatel.".phar");

$phar = new Phar($odesilatel.'.phar');
$phar->buildFromDirectory('./ExtractedPHAR');
echo "File ".$odesilatel,".phar packed";
?>

