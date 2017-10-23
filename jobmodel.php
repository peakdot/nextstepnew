<?php
session_start();

require("conn.php");
require("imagemodel.php");
require("test_input.php");
require("linktofb.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$type = get_input_post("type", 0, false);
	if($type == '0') {
		if(insertJob()) {
			echo "Insert Successful";
		} else {
			echo "Ажил оруулахад алдаа гарлаа.";
		}
	}
} 

function insertJob() {
	$regEmployer = 1;
	$regCompany = 1;
	$regType = 0;

	$orgName = get_input_ex("orgName",1,false);
	$jobName = get_input_ex("jobName",1,false);
	$salaryType = get_input_ex("salaryType",1,false);
	$salary = get_input_ex("salary",1,false);
	$phone1 = get_input_ex("phone1",1,false);
	$phone2 = get_input_ex("phone2",1,true);
	$email = get_input_ex("email",1,true);
	$lat = get_input_ex("coordx",1,true);
	$lng = get_input_ex("coordy",1,true);
	$startTime = get_input_ex("startTime",0,true);
	$endTime = get_input_ex("endTime",0,true);
	$gender = get_input_ex("gender",0,true);
	$age = get_input_ex("age",0,true);
	$edu = get_input_ex("edu",0,true);
	if(isset($_SESSION)) { 
		$regType = $_SESSION["usertype"];
		if($regType == 0) {
			$regEmployer = $_SESSION["id"];
		} else {
			$regCompany = $_SESSION["id"];		
		}
	}
	$mon = get_input_ex("mon",0,true);
	$tue = get_input_ex("tue",0,true);
	$wed = get_input_ex("wed",0,true);
	$thu = get_input_ex("thu",0,true);
	$fri = get_input_ex("fri",0,true);
	$sat = get_input_ex("sat",0,true);
	$sun = get_input_ex("sun",0,true);
	$week = (int)$mon*1+(int)$tue*2+(int)$wed*4+(int)$thu*8+(int)$fri*16+(int)$sat*32+(int)$sun*64;

	$accpro = uploadImage("coverimg", 617, 250, "imgs/");

	$data = array($jobName, $orgName, $accpro, $salaryType, $salary, $startTime, $endTime, $week, $lat, $lng, $email, $phone1, $phone2, $gender, $age, $edu, $regEmployer, $regCompany, $regType);

	$id = insertToDB("jobs", array("_jobName", "_orgName", "_orgLogo", "_salaryType", "_salary", "_startTime", "_endTime", "_week", "_lat", "_lng", "_email", "_phone1", "_phone2", "_gender", "_age", "_edu", "_regEmployerId", "_regCompanyId", "_regType"), array($data));

	if($id === false)
		return false;

	switch($salaryType){
		case '0': $salaryType = "Цагийн "; break;
		case '1': $salaryType = "Өдрийн "; break;
		case '2': $salaryType = "7 хоногоор "; break;
		case '3': $salaryType = "Сараар "; break;
	} 
	switch($gender){
		case '0': $gender = "Хүйс хамаагүй"; break;
		case '1': $gender = "Эрэгтэй"; break;
		case '2': $gender = "Эмэгтэй"; break;
	} 
	switch($age){
		case '0': $age = "Нас хамаагүй"; break;
		case '1': $age = "18-с 25 настай"; break;
		case '2': $age = "25-с 35 настай"; break;
		case '3': $age = "35-с дээш"; break;
	} 
	switch($edu){
		case '0': $edu = "Боловсрол хамаагүй"; break;
		case '1': $edu = "Бүрэн дунд боловсролтой"; break;
		case '2': $edu = "Дээд боловсролтой"; break;
	} 

	$message = 'Ажлын нэр: '.$jobName.'
	Ажиллах газрын нэр: '.$orgName.'

	Цалин: '.$salaryType.$salary.'₮'.'

	Утас: '.$phone1;

	if($phone2 != null && $phone2 != "" && $phone2 != 0) {
		$message .= ' '.$phone2;  
	}

	if($gender != null && $gender != "" && $gender != 0) {
		$message .= ' 

		Имэйл: '.$gender;  
	}

	$message .= '

	Шаардлагууд: 
	'.$gender.'
	'.$age.'
	'.$edu;

	$message .= '

	Линк: www.nextstep.mn/watch?id='.$id;

	$temppath = createJobImage($message);
    echo "12 ";


	$fbpost_id = postToFB($message, $temppath);	
    echo "13 ";


	editFromDB("jobs", array("_fbpost_id"), array($fbpost_id), "id=".$id);
    echo "14 ";


	unlink($temppath);
    echo "15 ";


	return true;
}

?>