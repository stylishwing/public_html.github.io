<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
echo "
	<html>
	<head>
	<title>訊息</title>
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
	<h1 style='font-size: 300%; font-family:Microsoft JhengHei;'>訊息</h1>
	</div>
	<h4 style = 'text-align:center;'>
	  <ul type = 'none'>
		<a href='index2.html' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>首頁</a>
		<a href='personal_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子個人錢包</a>
		<a href='common_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子共用錢包</a>
		<a href='member.php' style='font-size: 100%; color:white; text-decoration:none; padding: 20px;' target='_parent'>會員個人資料</a>
		<a href='friend.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>好友</a>
		
	  </ul>
	</h4>
	<br>
	";
	echo"<div style = 'overflow:scroll; max-height: 60%;'>";
	if($_SESSION['E_mail'] != null){
	    
		$sql = "SELECT * FROM member, friend, message where member.E_mail = '$_SESSION[E_mail]' and member.ID = friend.F_id and friend.User_id = message.U_id and member.ID = message.P_id and friend.Yes_or_No = '0' and message.t_id = '1'";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 150%; text-align:center;overflow:auto;'>";
		if($row = $result->fetch_row()){
			echo "ID : $row[9]的$row[10]向你$row[15]";
			echo "<form style = 'font-size: 150%;' action='/re_message2.php' method='post'>
					<input type='submit' value='是' name='yes' style = 'font-size: 40%;'>
					<input type ='button' onclick='history.back()' value='回到上一頁' style = 'font-size: 40%;'>
				</form> ";
				$conn->close();
		}
		echo"</div>";
		
		include("login2.php");
		$sql = "SELECT * FROM member, friend, message, wallet_relation 
				where member.E_mail = '$_SESSION[E_mail]' and member.ID = friend.F_id and friend.User_id = message.U_id and member.ID = message.P_id and friend.Yes_or_No = '1' and wallet_relation.yes_no = '0' and wallet_relation.uid = member.ID and message.t_id = '3'";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 150%; text-align:center;overflow:auto;'>";
		if($row = $result->fetch_row()){
			echo "ID : $row[9]的$row[10]向你$row[15]";
			echo "<form style = 'font-size: 150%;' action='/re_message3.php' method='post'>
					<input type='submit' value='是' name='yes' style = 'font-size: 40%;'>
					<input type ='button' onclick='history.back()' value='回到上一頁' style = 'font-size: 40%;'>
				</form> ";
				$conn->close();
		}
		echo"</div>";
		
		include("login2.php");
		$sql = "SELECT * FROM message, member where message.t_id = '2' and member.ID = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and message.P_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 120%; text-align:center;overflow:auto;'>";
		while($row = $result->fetch_row()){
			echo "ID : $row[3] &nbsp;";
			echo "名字：$row[8] ";
			echo " $row[2]";
			echo " [$row[5]]<br><br>";
		}
		$conn->close();
		echo"</div>";
		
		include("login2.php");
		$sql = "SELECT * FROM common_message, member where common_message.ct_id = '3' and member.ID = common_message.cp_id and common_message.cc_id = (SELECT c_id FROM wallet_relation where uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'))";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 120%; text-align:center; overflow:auto;'>";
		while($row = $result->fetch_row()){
			echo "ID : $row[4] &nbsp;";
			echo "名字：$row[9] ";
			echo " $row[3]";	
			echo " [$row[6]]<br><br>";
		}
		echo"</div>";
	}
	else{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
	}
	echo"</div>";
echo"
	<div style = 'text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;'>

	</div>

	</body>
	</html>";
?>