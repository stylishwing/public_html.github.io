<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include("login2.php");

$yes = $_POST["yes"];

if($_SESSION['E_mail'] != null){
	$sql = "UPDATE friend SET Yes_or_No = '1' WHERE F_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and User_id = (SELECT U_id FROM message where P_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and friend.Yes_or_No = '0')";
}

if ($conn->query($sql) === TRUE) { 
	
	echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
} 
else {
	echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
}

$conn->close();
?>