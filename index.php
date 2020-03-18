<?php 

$root = 'images';

$files = scandir($root);

foreach ($files as $key => $directory) {
    if ($directory == '.' || $directory == '..') continue;
    $dir = scandir($root .'/'. $directory);
    foreach ($dir as $item => $value) {
        if ($value == '.' || $value == '..') continue;
        $path = $root . '/' . $directory.'/';
        webpToJpeg($path, $value);
    }
}

function getFileName($filename) {
    $name = explode('.', $filename);
    return $name[0];
}

function webpToJpeg($path, $file) {
    $image = imagecreatefromwebp($path . '/' . $file);
    imagejpeg($image, $path.'/'.getFileName($file).'.jpg', 100);
    imagedestroy($image);
    unlink($path . $file);
}