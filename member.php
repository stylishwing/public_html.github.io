<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
echo "
	<html>
	<head>
	<title>會員個人資料</title>
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
	<h1 style='font-size: 300%; font-family:Microsoft JhengHei;'>會員資料</h1>
	</div>
	<h4 style = 'text-align:center;'>
	  <ul type = 'none'>
		<a href='index2.html' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>首頁</a>
		<a href='personal_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子個人錢包</a>
		<a href='common_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子共用錢包</a>
		<a href='friend.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>好友</a>
		<a href='re_message.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>訊息</a>
		
	  </ul>
	</h4>
	<br>
	";
	echo"<div style= 'text-align:center;'><img src='/avatar.png' width='100px' height='100px'></div><br>";
	if($_SESSION['E_mail'] != null){
		$sql = "SELECT * FROM member where E_mail = '$_SESSION[E_mail]'";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'text-align:center;font-family:Microsoft JhengHei;margin:10px;'>";
		while($row = $result->fetch_row()){
		    echo"<table width='500' border='2' align='center' style = 'font-size: 150%; font-family:Microsoft JhengHei;'>";
		    echo"<tr>";
			echo"<td>會員ID</td> <td align='center'>$row[0]</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td>會員名稱</td> <td align='center'>$row[2]</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td>信用卡編號</td> <td align='center'>$row[4]</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td>E-mail</td> <td align='center'>$row[1]</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td>電話</td> <td align='center'>$row[5]</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td>手機電話</td> <td align='center'>$row[6]</td>";
			echo"</tr>";
			echo"<tr>";
			echo"<td>生日</td> <td align='center'>$row[7]</td>";
			echo"</tr>";
			echo"</table><br>";
		}
		echo"</div>";
	}
	else{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
	}
echo"
	<div style = 'text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;'>

	</div>

	</body>
	</html>";
?>
