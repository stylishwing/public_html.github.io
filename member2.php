<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include("login2.php");
if($_SESSION['E_mail'] != null){
		$sql = "SELECT * FROM member where E_mail = '$_SESSION[E_mail]'";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 150%; text-align:left;font-family:Microsoft JhengHei;'>";
		while($row = $result->fetch_row()){
			echo"會員ID : $row[0]<br>";
			echo"會員名稱 : $row[2]<br>";
			echo"信用卡編號 : $row[4]<br>";
			echo"生日 : $row[7]<br>";
		}
		echo"</div>";
	}
	else{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
	}
?>