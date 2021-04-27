<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php 
include("login2.php");
$WalletMember = array();
$uid = 0;

if($_SESSION['E_mail'] != null){
    $sql = "SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'";
		$result = $conn->query($sql) or die('MySQL query error');
		if($row = $result->fetch_row()){
		    $uid = $row[0];
		}
}
$conn->close();
?>

<?php 
include("login2.php");
$Fid = $_POST["fid"];
$have = 0;
if($_SESSION['E_mail'] != null){
    $sql = "SELECT Yes_or_No FROM friend where User_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and F_id = '$Fid'";
		$result = $conn->query($sql) or die('MySQL query error');
		if($row = $result->fetch_row()){
		    $have = $row[0];
		}
}
$conn->close();
?>

<?php
include("login2.php");
$friend = "";
$error = '';
$error2 = '';

if(isset($_POST) && $have != 1){
    if(empty($Fid) && !empty($_POST["send"])){
        $error = "請輸入欲加好友的ID";
    }
    if(!empty($Fid)){
        if($Fid == $uid){
            $error2 = "請勿輸入自己的ID";
        }
        else if($Fid != $uid){
            if($_SESSION['E_mail'] != null){
            	$sql = "INSERT INTO `friend` (`Friend_ID`,`User_id`,`User_name`,`F_id`,`Yes_or_No`) 
            		VALUES (NULL, (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), (SELECT Name FROM member where E_mail = '$_SESSION[E_mail]'), '$Fid', '0')";
            		
            }
            
            if ($conn->query($sql) === TRUE) {
            	$conn->close();
            	include("login2.php");
            	$date = date("Y/m/d");
            
            	$sql = "INSERT INTO `message` (`M_id`,`U_id`,`message`,`P_id`,`t_id`,`m_date`) 
            			VALUES (NULL, (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), '提出好友申請', '$Fid', '1', '$date')";
            
            	if ($conn->query($sql) === TRUE) {
            	    $conn->close();
                	include("login2.php");
                	
                	$sql = "INSERT INTO `friend` (`Friend_ID`,`User_id`,`User_name`,`F_id`,`Yes_or_No`) 
            		VALUES (NULL,  '$Fid', (SELECT Name FROM member where ID = '$Fid'), (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), '0')";
            		
            		if ($conn->query($sql) === TRUE){
            		    echo "申請成功";
            		    echo '<meta http-equiv=REFRESH CONTENT=2;url=index2.html>';
            		}
            		else {
                		echo "申請失敗" . $conn->error;
                	}
            	} 
            	else {
            		echo "申請失敗" . $conn->error;
            	}
            }
            
            else {
                echo "申請失敗" . $conn->error;
            	
            }
        }
        
    }
    
}
else{
    $friend = "這名會員已經是你的好友了";
}

$conn->close();
?>


<html>
    <head>
    <title>好友</title>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
        input[type="text"] {
            padding: 5px 15px;
            border: 2px black solid;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 5px 15px;
            background: #ccc;
            border: 0 none;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }


        input[type="button"] {
            padding: 5px 15px;
            background: #ccc;
            border: 0 none;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }
        h4 {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #111111;
        	text-align:right;
        }
        a {
        	text-decoration: none
        }
</style>
</head>
<body>
<div style='text-align:right;background-color:#111111;color:white;font-family:Microsoft JhengHei;font-size:135%;'>已登入|<a href='logout.php' style='color:yellow;text-decoration:none;' target='_parent'>登出</a></div>

<div style = "text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;">
<h1 style="font-size: 300%; font-family:Microsoft JhengHei;">好友</h1>
</div>
<h4 style = 'text-align:center;'>
  <ul type = "none">
	<a href="index2.html" style="color:white; padding: 20px;" target="_parent">首頁</a>
	<a href="personal_wallet.php" style="font-size: 100%; color:white; padding: 20px;" target="_parent">電子個人錢包</a>
	<a href="common_wallet.php" style="font-size: 100%; color:white; padding: 20px;" target="_parent">電子共用錢包</a>
	<a href="member.php" style="font-size: 100%; color:white; padding: 20px;" target="_parent">會員個人資料</a>
	<a href="friend.php" style="font-size: 100%; color:white; padding: 20px;" target="_parent">好友</a>
	<a href="re_message.php" style="font-size: 100%; color:white; padding: 20px;" target="_parent">訊息</a>
	
  </ul>
</h4>
<form style = "font-size: 200%; text-align:center;" action="" method="post">
  <br>
  好友ID:
  <br>
  <input type="text" name="fid" style = "font-size: 85%;">
  <br>
  <?php echo "<span style = 'color:#FF0000;font-size:80%;'>$error$error2$friend</span>";?>
  <br><br>
  <input type="submit" value="送出" style = "font-size: 85%;" name="send">
  <input type ="button" onclick="history.back()" value="回到上一頁" style = "font-size: 85%;">
</form> 
<br>

<div style = "text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;">

</div>

</body>
</html>
