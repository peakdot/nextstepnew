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
        return "picincerr1";
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
?>