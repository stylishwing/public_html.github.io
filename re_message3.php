<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include("login2.php");

$yes = $_POST["yes"];


if($_SESSION['E_mail'] != null){
	$sql = "UPDATE wallet_relation SET yes_no = '1' WHERE uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and Manager_id = (SELECT manager_id FROM common_wallet where manager_id = (SELECT User_id FROM friend where F_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')))";
}

if ($conn->query($sql) === TRUE) { 
	echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
} 
else {
	echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
}

$conn->close();
?>