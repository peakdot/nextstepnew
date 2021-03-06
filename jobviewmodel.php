<?php
session_start();

require("conn.php");
require("test_input.php");
require("linktofb.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
	$t = get_input_get("t", 0, false);
	if($t == '0') {
		echo json_encode(getAllBriefJobInfos());
	} else if($t == '1') {
		$id = get_input_get("id", 0, false);
		echo json_encode(getFullJobInfo($id));
	} else if($t == '4') {
		//AddJob
		$id = get_input_get("id", 0, false);
		if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
			if(allowJob($id)) {
				echo "Allowed job. ID:".$id;
			} else {
				echo "Cant allow job. ID:".$id;			
			}
		}
	} else if($t == '5') {
		//RemoveJob
		$id = get_input_get("id", 0, false);
		if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
			if(removeJob($id)) {
				echo "Removed job. ID:".$id;
			} else {
				echo "Cant remove job. ID:".$id;			
			}
		}
	}
} 

function getAllBriefJobInfos() {
	if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
		$res = getFromDB("jobs", array("id", "_jobName", "_orgName", "_orgLogo", "_salaryType", "_salary", "_lat", "_lng", "_regDate"), "_isAllowed = false");
	} else {
		$res = getFromDB("jobs", array("id", "_jobName", "_orgName", "_orgLogo", "_salaryType", "_salary", "_lat", "_lng", "_regDate"));
	}
	return $res;
}

function getFullJobInfo($id) {
	$res = getFromDBSecure("jobs", array("id", "_jobName", "_orgName", "_orgLogo", "_salaryType", "_salary", "_startTime", "_endTime", "_week", "_email", "_phone1", "_phone2", "_gender", "_age", "_edu", "_regEmployerId", "_regCompanyId", "_regType", "_regDate"), array("id"), "id=?", array($id));
	return $res;
}

function allowJob($id) {
	if(editFromDB("jobs", array("_isAllowed"), array("true"), "id=".$id)){
		return true;
	} else {
		return false;
	}
}

function removeJob($id) {
	$res = getFromDBSecure("jobs", array("_fbpost_id", "_orgLogo"), "id=".$id)[0]
	unlink($res["_orgLogo"]);
	removeFBPost($res["_fbpost_id"]);
	if(removeFromDB("jobs", "id=".$id)){
		return true;
	} else {
		return false;
	}
}
?>