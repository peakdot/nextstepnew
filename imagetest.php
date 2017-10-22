<?php
$job = json_decode('{"id":22,"_jobName":"Looooooooooooooooong Looooooooooooooooong","_orgName":"Looooooooooooooooong Looooooooooooooooong","_orgLogo":"201710080947_1Lj6mXvEz7w5VNnYBOKGxyIkl2uAaf.jpg","_salaryType":0,"_salary":1210000,"_startTime":9,"_endTime":18,"_week":24,"_email":null,"_phone1":12313,"_phone2":123123,"_gender":1,"_age":0,"_edu":0,"_regEmployerId":1,"_regCompanyId":1,"_regType":0,"_regDate":"2017-10-08 17:47:32"}');

createJobImage($job);

function createJobImage($job) {
	switch($job->_salaryType){
		case '0': $job->_salaryType = "Цагийн"; break;
		case '1': $job->_salaryType = "Өдрийн"; break;
		case '2': $job->_salaryType = "7 хоногоор"; break;
		case '3': $job->_salaryType = "Сараар"; break;
	} 

	$stamp = imagecreatefrompng('nextstepg.png');

	$marge_right = 10;
	$marge_bottom = 10;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);

	$im = imagecreatetruecolor(600, 600);
	$white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
	$black = imagecolorallocate($im, 0x00, 0x00, 0x00);

	// Make the background white
	imagefilledrectangle($im, 0, 0, 600, 600, $white);

	imagecopymerge_alpha($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

	// Path to our ttf font file
	$font_file = 'fonts/roboto/Roboto-Regular.ttf';

	$xposition = 55;

	imagefttext($im, 18, 0, 50, $xposition, $black, $font_file, "Ажлын нэр:");
	imagefttext($im, 18, 0, 50, $xposition += 32, $black, $font_file, $job->_jobName);
	imagefttext($im, 18, 0, 50, $xposition += 48, $black, $font_file, "Ажиллах газрын нэр:");	
	imagefttext($im, 18, 0, 50, $xposition += 32, $black, $font_file, $job->_orgName);
	imagefttext($im, 18, 0, 50, $xposition += 48, $black, $font_file, "Цалин:");	
	imagefttext($im, 18, 0, 50, $xposition += 32, $black, $font_file, $job->_salaryType." ".$job->_salary." төгрөг");
	imagefttext($im, 18, 0, 50, $xposition += 48, $black, $font_file, "Утасны дугаар:");
	imagefttext($im, 18, 0, 50, $xposition += 32, $black, $font_file, $job->_phone1);
	imagefttext($im, 18, 0, 50, $xposition += 48, $black, $font_file, "И-мэйл хаяг:");
	imagefttext($im, 18, 0, 50, $xposition += 32, $black, $font_file, $job->_email);

	// Output image to the browser
	header('Content-Type: image/png');

	imagepng($im);
	imagedestroy($im);
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