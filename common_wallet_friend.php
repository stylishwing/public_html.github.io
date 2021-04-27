<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
include("login2.php");
$Fid = $_POST["id"];


if($_SESSION['E_mail'] != null){
	$sql = "INSERT INTO `wallet_relation` (`Manager_id`,`uid`,`uname`,`c_id`,`yes_no`,`money`) 
		VALUES ((SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), '$Fid', (SELECT Name FROM member where ID = '$Fid'), (SELECT C_id FROM common_wallet where manager_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')), '0', '0')";
		
}

if ($conn->query($sql) === TRUE) {
	$conn->close();
	include("login2.php");

	$sql = "INSERT INTO `message` (`M_id`,`U_id`,`message`,`P_id`,`t_id`) 
			VALUES (NULL, (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), '提出共用錢包申請', '$Fid', '3')";

	if ($conn->query($sql) === TRUE) {
		echo "申請成功";
		echo '<meta http-equiv=REFRESH CONTENT=2;url=index2.html>';
	} 
	else {
		echo "申請失敗" . $conn->error;
	}
}

else {
    echo "申請失敗" . $conn->error;
	echo '<meta http-equiv=REFRESH CONTENT=1;url=index2.html>';
}
$conn->close();
