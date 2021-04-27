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
	<style>
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
	$sql = "SELECT * FROM friend, member where friend.User_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and friend.Yes_or_No = '1' and friend.F_id = member.ID";
	$result = $conn->query($sql) or die('MySQL query error');
	echo"<div style = 'font-size: 120%; text-align:center;'>";
	while($row = $result->fetch_row()){
		foreach ($row as $i => $value){
				if(($i % 13) == 3){
					echo "好友 ID : $value &nbsp;&nbsp;";
				}
				if(($i % 13) == 7){
					echo "名字：$value<br>";
				}
		}
	}
	echo"</div>";
	$conn->close();
	echo "<form style = 'font-size: 200%; text-align:center;' action='/common_wallet_friend.php' method='post'>
			<br>
			好友ID : 
			<input type='text' name='id'  style = 'font-size: 80%;'>
			<br>
			<br>
			<input type='submit' value='送出' style = 'font-size: 80%;'>
			<br>
			</form>
		";
echo"
	<div style = 'text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;'>

	</div>

	</body>
	</html>";
?>