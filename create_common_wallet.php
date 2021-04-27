<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include("login2.php");
$money = $_POST["money"];

if($_SESSION['E_mail'] != null){
	$sql = "INSERT INTO `common_wallet` (`C_id`,`manager_id`,`manager_name`,`c_money`) 
		VALUES (NULL, (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), (SELECT Name FROM member where E_mail = '$_SESSION[E_mail]'), '$money')";
}


if ($conn->query($sql) === TRUE) {
	$conn->close();
	include("login2.php");
	
	$sql = "INSERT INTO `wallet_relation` (`Manager_id`,`uid`,`uname`,`c_id`,`yes_no`,`money`) 
		VALUES ((SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), (SELECT Name FROM member where E_mail = '$_SESSION[E_mail]'), (SELECT C_id FROM common_wallet where manager_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')), '1', '$money')";
	
	if ($conn->query($sql) === TRUE) {
		$conn->close();
		include("login2.php");
		
		$sql = "UPDATE personal_wallet SET money = money - $money WHERE User_ID = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')";
		
		if ($conn->query($sql) === TRUE) {
			echo "創建成功";
			echo '<meta http-equiv=REFRESH CONTENT=2;url=common_wallet.php>';
		} 
		else {
			echo "創建失敗" . $conn->error;
		}
	} 
	else {
		echo "創建失敗" . $conn->error;
	}
} 

else {
    echo "創建失敗" . $conn->error;
}

$conn->close();
?>