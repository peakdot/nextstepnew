<?php
function uploadImage($file, $maxwidth, $maxheight, $destination) {

    $target_file_name = createNameforImage();

    //Get image type
    $imageFileType = trim(strtolower(pathinfo(basename($_FILES[$file]["name"]),PATHINFO_EXTENSION)));
    $target_file =$target_file_name.".".$imageFileType;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$file]["tmp_name"]);
        if($check === false) {
            return "picexterr";
        }
    }

    // Check if file already exists
    if (!file_exists($_FILES[$file]["tmp_name"])) {
        return "defaultjob.png";
    }

    // Check file size
    if ($_FILES[$file]["size"] > 50*1024*1024) {
        return "pictoolarge";
    }

    if ($_FILES[$file]["size"] < 3*1024) {
        return $_FILES[$file]["size"];
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return "picexterr".$imageFileType;
    }

    // if everything is ok, try to upload file
    if (saveImage($_FILES[$file]["tmp_name"], $imageFileType, $maxwidth, $maxheight, $destination.$target_file)){
        return $target_file;
    } else {
        return "picincerr3";
    }
}



function saveImage($source, $ext, $maxwidth, $maxheight, $destination) {
    list($newwidth, $newheight) = list($width, $height) = getimagesize($source);
    if($maxwidth < $width || $maxheight < $height) { 
        $ratioh = $height / $maxheight;
        $ratiow = $width / $maxwidth;
        $ratio = min($ratioh, $ratiow);
        // New dimensions
        $newwidth = intval($ratio * $width);
        $newheight = intval($ratio * $height);
        $size = min($width, $height);
    }

    $newImage = imagecreatetruecolor($newwidth, $newheight);

    $sourceImage = null;

    // Generate source image depending on file type
    switch ($ext) {
        case "jpg":
        $sourceImage = imagecreatefromjpeg($source);
        break;
        case "jpeg":
        $sourceImage = imagecreatefromjpeg($source);
        break;
        case "gif":
        $sourceImage = imagecreatefromgif($source);
        break;
        case "png":
        $sourceImage = imagecreatefrompng($source);
        break;
    }

    if ($sourceImage == false){
        return false;
    }

    if(imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newwidth, $newheight, $width, $height)==false){
        return false;
    }
    
    // Output file depending on type
    switch ($ext) {
        case "jpg":
        $res = imagejpeg($newImage, $destination);
        break;
        case "jpeg":
        $res = imagejpeg($newImage, $destination);
        break;
        case "gif":
        $result = imagegif($newImage, $destination);
        break;
        case "png":
        $res = imagepng($newImage, $destination);
        break;
        default: 
        return false;
    }

    if($res == false){
        return false;
    } else {        
        return true;
    }
}

function createNameforImage() {
    $seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789'); 
    // and any other characters
    shuffle($seed); 
    // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 30) as $k) $rand .= $seed[$k];   
    $date = Date("Y").Date("m").Date("d").Date("H").Date("i");
    $accpro = $date.'_'.$rand;
    return $accpro;
}


function createJobImage($message) {
    $stamp = imagecreatefrompng('nextstepg.png');

    echo "1 ";

    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    echo "2 ";


    $im = imagecreatetruecolor(600, 600);
    $white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
    $black = imagecolorallocate($im, 0x00, 0x00, 0x00);
    echo "3 ";


    // Make the background white
    imagefilledrectangle($im, 0, 0, 600, 600, $white);
    echo "4 ";


    imagecopymerge_alpha($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);
    echo "5 ";


    // Path to our ttf font file
    $font_file = 'fonts/roboto/Roboto-Regular.ttf';
    echo "6 ";


    $xposition = 55;
    echo "7 ";


    imagefttext($im, 18, 0, 50, $xposition, $black, $font_file, $message);
    echo "8 ";


    $temppath = '/temp/'.createNameforImage().'.png';
    echo "9 ";

    echo $temppath;
    imagepng($im, $temppath);
    echo "10 ";

    imagedestroy($im);
    echo "11 ";


    return $temppath;
}

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
    // creating a cut resource 
    $cut = imagecreatetruecolor($src_w, $src_h); 

    // copying relevant section from background to the cut resource 
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 

    // copying relevant section from watermark to the cut resource 
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 

    // insert cut resource to destination image 
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
} 
?>