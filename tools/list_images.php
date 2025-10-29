<?php
$files = ['public/img/banner2.png','public/img/banner3.jpg','public/img/banner4.jpg','public/img/Banner5.jpg'];
foreach($files as $f){
    if(file_exists($f)){
        $s = getimagesize($f);
        $size = filesize($f);
        echo basename($f)." {$s[0]}x{$s[1]} ".round($size/1024,1)."KB\n";
    } else {
        echo basename($f)." not found\n";
    }
}
