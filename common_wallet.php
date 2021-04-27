<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
echo "
	<html>
	<head>
	<title>電子共用錢包</title>
	<style>
	h4 {
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #111111;
		text-align:right;
	}
	</style>
	</head>
	<body>
	<div style='text-align:right;background-color:#111111;color:white;font-family:Microsoft JhengHei;font-size:135%;'>已登入|<a href='logout.php' style='color:yellow;text-decoration:none;' target='_parent'>登出</a></div>
	<div style = 'text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;'>
	<h1 style='font-size: 300%; font-family:Microsoft JhengHei;'>電子共用錢包</h1>
	</div>
	<h4 style = 'text-align:center;'>
	  <ul type = 'none'>
		<a href='index2.html' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>首頁</a>
		<a href='personal_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子個人錢包</a>
		<a href='member.php' style='font-size: 100%; color:white; text-decoration:none; padding: 20px;' target='_parent'>會員個人資料</a>
		<a href='friend.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>好友</a>
		<a href='re_message.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>訊息</a>
		
	  </ul>
	</h4>
	<br>
	";
	$sql = "SELECT * FROM common_wallet, wallet_relation 
			where wallet_relation.uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and wallet_relation.uname = (SELECT Name FROM member where E_mail = '$_SESSION[E_mail]') and wallet_relation.c_id = common_wallet.C_id and wallet_relation.yes_no = '1'";
	$result = $conn->query($sql) or die('MySQL query error');
	echo"<div style = 'font-size: 150%; text-align:center;'>";
	if($row = $result->fetch_row()){
		echo"餘額 : $row[3]<br>";
		echo"<div style = 'font-size: 150%; text-align:center;'>
			<a href='save2.php' style='font-size: 80%; color:blue; font-family:PMingLiU; text-decoration:none;' target='_parent'>存款</a> | ";
		echo"<a href='payment2.php' style='font-size: 80%; color:blue; font-family:PMingLiU; text-decoration:none;' target='_parent'>付款</a>";
			if($row[1] == $row[5]){
				echo" | <a href='add_friend.php' style='font-size: 80%; color:blue; font-family:PMingLiU; text-decoration:none;' target='_parent'>將好友加進來</a>";
				echo" | <a href='Custom.php' style='font-size: 80%; color:blue; font-family:PMingLiU; text-decoration:none;' target='_parent'>自訂</a>";
			}
			echo"</div>";
	}
	else{
		echo"<div style = 'font-size: 150%; text-align:center;'> 創建共用錢包";
		echo "<form style = 'font-size: 100%; text-align:center;' action='/create_common_wallet.php' method='post'>
					<br>
					金額:
					<input type='text' name='money'  style = 'font-size: 80%;'>
					<br>
					<input type='submit' value='創建錢包' style = 'font-size: 60%;'>
					<br><br>
					</form>
				";
	}
	echo"</div>";
echo"
	<div style = 'text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;'>

	</div>

	</body>
	</html>";
?>