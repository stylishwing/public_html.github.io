<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
echo "
	<html>
	<head>
	<title>電子個人錢包</title>
	<style>
	h4 {
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #111111;
		text-align:right;
	}
	
	input[type='text'] {
            padding: 5px 15px;
            border: 2px black solid;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
	    input[type='submit'] {
            padding: 5px 15px;
            background: #ccc;
            border: 0 none;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }

        input[type='button'] {
            padding: 5px 15px;
            background: #ccc;
            border: 0 none;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
	</style>
	</head>
	<body>
	<div style='text-align:right;background-color:#111111;color:white;font-family:Microsoft JhengHei;font-size:135%;'>已登入|<a href='logout.php' style='color:yellow;text-decoration:none;' target='_parent'>登出</a></div>
	<div style = 'text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;'>
	<h1 style='font-size: 300%; font-family:Microsoft JhengHei;'>電子個人錢包</h1>
	</div>
	<h4 style = 'text-align:center;'>
	  <ul type = 'none'>
		<a href='index2.html' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>首頁</a>
		<a href='common_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子共用錢包</a>
		<a href='member.php' style='font-size: 100%; color:white; text-decoration:none; padding: 20px;' target='_parent'>會員個人資料</a>
		<a href='friend.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>好友</a>
		<a href='re_message.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>訊息</a>
		
	  </ul>
	</h4>
	<br>
	";
	$sql = "SELECT * FROM member, personal_wallet where member.E_mail = '$_SESSION[E_mail]' and member.CreditCardNumber = personal_wallet.CCNumber";
	$result = $conn->query($sql) or die('MySQL query error');
	echo"<div style = 'font-size: 150%; text-align:center;'>";
	if($row = $result->fetch_row()){
		echo"餘額 : $row[12]<br>";
		echo"<div style = 'font-size: 150%; text-align:center;'>
			<a href='save.php' style='font-size: 80%; color:blue; font-family:PMingLiU; text-decoration:none;' target='_parent'>存款</a> | 
			<a href='payment.php' style='font-size: 80%; color:blue; font-family:PMingLiU; text-decoration:none;' target='_parent'>付款</a>
			</div>";
	}
	else{
		echo"<div style = 'font-size: 150%; text-align:center;'> 創建個人錢包";
			echo "<form style = 'font-size: 100%; text-align:center;' action='/create_personal_wallet.php' method='post'>
					<br>
					信用卡卡號:
					<br>
					<input type='text' name='CreditCardNumber'  style = 'font-size: 80%;'>
					<br>
					金額:
					<br>
					<input type='text' name='money'  style = 'font-size: 80%;'>
					<br><br>
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