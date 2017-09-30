<?php
session_start();

require("conn.php");
require("uploadimg.php");
require("test_input.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$type = get_input_post("type", 0, false);
	if($type == '0') {
		echo insertJob();
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

	$accpro = uploadImage("coverimg", 617, 160, "imgs/");
	echo "Hello im jobmodel";

	$data = array($jobName, $orgName, $accpro, $salaryType, $salary, $startTime, $endTime, $week, $lat, $lng, $email, $phone1, $phone2, $gender, $age, $edu, $regEmployer, $regCompany, $regType);

	$id = insertToDB("jobs", array("_jobName", "_orgName", "_orgLogo", "_salaryType", "_salary", "_startTime", "_endTime", "_week", "_lat", "_lng", "_email", "_phone1", "_phone2", "_gender", "_age", "_edu", "_regEmployerId", "_regCompanyId", "_regType"), array($data));

	if($id === false)
		return "false".$accpro.$id;
	
	return "true".$accpro.$id;
}

?>