<?php
session_start();

require_once("test_input.php");
require_once("conn.php");

/*
Type 1 -> Sign in 
Type 2 -> Sign up 
Type 3 -> Edit user
Type 4 -> Remove user 
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$type = get_input_post("type", 0, false);
	if($type == '0') {
		list($email, $password) = getLoginInfoFromUser();
		if(login($email, $password)) {
			echo "Login Successful";
		} else {
			echo "И-мэйл эсвэл нууц үг буруу байна.";
		}
	} else if($type == '1') {
		list($email, $password, $fname, $lname) = getSignUpInfoFromUser();
		if(insertUser($email, $password, $fname, $lname)) {
			echo "Signed up Successful";
		} else {
			echo "Sign up fail";
		}
	} else if($type == '2'){
		editUser();
	} else if($type == '3'){
		removeUser();
	}	
} 

function getLoginInfoFromUser(){
	$email = get_input_post("email", 1, false);
	$password = get_input_post("password", 1, false);
	return array($email, $password);
}

function login($email, $password){
	$password = hash('sha512', $password."Xoxo");
	//User login
	$res1 = getFromDBSecure("ns_users", array("id", "_fname", "_lname", "_email", "_phone", "_accpro", "_isAdmin"), array("_email", "_password"), "_email = ? and _password = ?", array($email, $password));
	//Company login
	$res2 = getFromDBSecure("ns_companys", array("id", "_name", "_email", "_phone1", "_phone2", "_logo"), array("_email", "_password"), "_email = ? and _password = ?", array($email, $password));

	if(count($res1) == 0 && count($res2) == 1) {
		$type = 1;
	} else if(count($res1) == 1 && count($res2) == 0) {
		$type = 0;
	} else {
		return false;
	}

	if($type == 0) {
		$_SESSION["usertype"] = $type;
		$_SESSION["id"] = $res1[0]["id"];
		$_SESSION["fname"] = $res1[0]["_fname"];
		$_SESSION["lname"] = $res1[0]["_lname"];
		$_SESSION["email"] = $res1[0]["_email"];
		$_SESSION["phone"] = $res1[0]["_phone"];
		$_SESSION["accpro"] = $res1[0]["_accpro"];
		if($res1[0]["_isAdmin"]=='1') {
			$_SESSION["isAdmin"] = 1;
		} else {
			$_SESSION["isAdmin"] = 0;
		}
	} else {
		$_SESSION["usertype"] = $type;
		$_SESSION["id"] = $res2[0]["id"];
		$_SESSION["name"] = $res2[0]["_name"];
		$_SESSION["email"] = $res2[0]["_email"];
		$_SESSION["phone1"] = $res2[0]["_phone1"];
		$_SESSION["phone2"] = $res2[0]["_phone2"];
		$_SESSION["accpro"] = $res2[0]["_logo"];
		$_SESSION["isAdmin"] = 0;
	}

	return true;

}

function insertUser($email, $password, $fname, $lname) {
	$data = array($email, hash('sha512', $password."Xoxo"), $fname, $lname);

	$id = insertToDB("ns_users", array("_email", "_password", "_fname", "_lname"), array($data));

	if($id === false) {
		return "Бүртгэлтэй хаяг байна.";
	} 

	// Email the new password to the person.
	$message = "Сайн байна уу! ".$fname." ".$lname."

	Та манай туршилтын туулай боллоо.

	Та манай сайтад дараах кодыг оруулж бүртгэлээ баталгаажуулна уу.

	http://www.nextstep.mn/verify.php?userid=".$id."code=".createVerificationCode();

	mail($email,"Бүртгэл баталгаажуулах",
		$message, "From:Nextstep <peakdot1@gmail.com>");

	return login($email, $password);
}

function editUser(){
	$name = get_input("name");
	echo "Success: ".$name;
}

function createVerificationCode() {
    $seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789'); 
    // and any other characters
    shuffle($seed); 
    // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 30) as $k) $rand .= $seed[$k];   
    $date = Date("Y").Date("m").Date("d").Date("H").Date("i");
    $code = $date.'_'.$rand;
    return $code;
}
?>