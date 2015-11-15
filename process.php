<?php 
$imgURL = base64_decode($_REQUEST['img']);
$userId = $_REQUEST['user'];
// Create image instances
$file = fopen("log.txt", "a");
fwrite($file, $userId."||".$imgURL."\r\n");
fclose($file);

$dest = @imagecreatefromjpeg ($imgURL);
$destSize = getimagesize($imgURL);
$destWidth = $destSize[0];
$destHeight = $destSize[1];

$src = @imagecreatefromjpeg ('flags.jpg');
$srcSize = getimagesize('flags.jpg');
$srcWidth = $srcSize[0];
$srcHeight = $srcSize[1];


$newSrc = imagecreatetruecolor ( $destWidth , $destHeight );
imagecopyresized($newSrc, $src, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);


// Copy and merge
imagecopymerge($dest, $newSrc, 0, 0, 0, 0, $destWidth, $destHeight, 50);

// Output and free from memory
header('Content-Type: image/jpeg');
imagejpeg($dest);

imagedestroy($src);
imagedestroy($dest);

?>