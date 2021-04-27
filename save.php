<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
$money = $_POST["money"];
$money_err = 1;
if(isset($_POST) && !empty($money)){
    if($money <= 1000){
        if($_SESSION['E_mail'] != null){
        	$sql = "UPDATE personal_wallet SET money = money + $money WHERE CCNumber = (SELECT CreditCardNumber FROM member where E_mail = '$_SESSION[E_mail]')";
        }
        
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            include("login2.php");
            $sql = "SELECT * FROM member, personal_wallet where member.E_mail = '$_SESSION[E_mail]' and member.CreditCardNumber = personal_wallet.CCNumber";
	        $result = $conn->query($sql) or die('MySQL query error');
            if($row = $result->fetch_row()){
                $money_after = $row[12];
            }
        } 
        else {
            echo "存款失敗" . $conn->error;
        	echo '<meta http-equiv=REFRESH CONTENT=2;url=index2.html>';
        }
    }
    else {
        $money_err = 0;
    }
}

$conn->close();
?>

<html>
<title>存款</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
    <style>
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
    </style>

<div style = "text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;">
<h1 style="font-size: 300%; font-family:Microsoft JhengHei;">存款</h1>
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
  <?php if($money_after != 0) echo "目前餘額：" . $money_after;?>
  <br>
  請輸入存款的金額:
  <br>
  <input type="text" name="money" style = "font-size: 85%;">
  <br>
  <?php if($money_err == 0){
      echo "<span style = 'color:#FF0000;font-size:100%;'>存入金額過大</span><br />";
  }?>
  <br>
  <input type="submit" value="送出" style = "font-size: 85%;">
  <input type ="button" onclick="history.back()" value="回到上一頁" style = "font-size: 85%;">
</form> 
<br>

<div style = "text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;">

</div>

</body>
</html>