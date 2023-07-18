<?php
echo rrmdir('ExtractedPHAR');
function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
} 

$odesilatel = $_POST['ExtractFileName'];

$phar = new Phar($odesilatel.'.phar');
$phar->extractTo('./ExtractedPHAR'); // extract all files

echo "File ".$odesilatel,".phar unpacked.";
?>