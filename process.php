<?php 
$imgURL = base64_decode($_REQUEST['img']);
$userId = $_REQUEST['user'];
// Create image instances
$file = fopen("log.txt", "a");
fwrite($file, $userId."||".$imgURL."\r\n");
fclose($file);

$dest = @imagecreatefromjpeg ($imgURL);
$src = @imagecreatefromjpeg ('flags.jpg');

// Copy and merge
imagecopymerge($dest, $src, 0, 0, 0, 0, 960, 960, 50);

// Output and free from memory
header('Content-Type: image/jpeg');
imagejpeg($dest);

imagedestroy($src);
imagedestroy($dest);

?>