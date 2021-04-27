<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include("login2.php");
$text1 = $_POST["CreditCardNumber"];
$text2 = $_POST["money"];

if($_SESSION['E_mail'] != null){
	$sql = "INSERT INTO `personal_wallet` (`W_ID`,`User_ID`,`Username`,`CCNumber`,`money`) 
		VALUES (NULL, (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), (SELECT Name FROM member where E_mail = '$_SESSION[E_mail]'), '$text1', '$text2')";
}


if ($conn->query($sql) === TRUE) {
    echo "創建成功";
	echo '<meta http-equiv=REFRESH CONTENT=2;url=personal_wallet.php>';
} 
else {
    echo "創建失敗" . $conn->error;
}

$conn->close();
?>
