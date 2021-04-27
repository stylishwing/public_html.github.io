<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
$have_money = 0;


if($_SESSION['E_mail'] != null){
    $sql = "SELECT * FROM personal_wallet WHERE CCNumber = (SELECT CreditCardNumber FROM member where E_mail = '$_SESSION[E_mail]')";
		$result = $conn->query($sql) or die('MySQL query error');
		if($row = $result->fetch_row()){
		   $have_money = $row[4];
		}
}

$conn->close();
?>

<?php 
include("login2.php");
$money = $_POST["money"];
$error = "";
$error2 = "";

if(isset($_POST) && !empty($_POST["send"])){
    if(!empty($money)){
        if($have_money - $money >= 0){
            if($_SESSION['E_mail'] != null){
                $sql = "UPDATE personal_wallet SET money = money - $money WHERE CCNumber = (SELECT CreditCardNumber FROM member where E_mail = '$_SESSION[E_mail]')";
            }
            if ($conn->query($sql) === TRUE) {
            	$conn->close();
            	include("login2.php");
            	$date = date("Y/m/d");
            
            	$sql = "INSERT INTO `message` (M_id,U_id,message,P_id,t_id,m_date) 
            			VALUES (NULL, '10001', '你已花費了$money 元', (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), '2', '$date')";
            
            	if ($conn->query($sql) === TRUE) {
            		echo "付款成功";
            		echo '<meta http-equiv=REFRESH CONTENT=2;url=personal_wallet.php>';
            	} 
            	else {
            		echo "付款失敗" . $conn->error;
            		echo '<meta http-equiv=REFRESH CONTENT=2;url=index2.html>';
            	}
            } 
            else {
                echo "付款失敗" . $conn->error;
            	echo '<meta http-equiv=REFRESH CONTENT=2;url=index2.html>';
            }
        }
        else{
            $error2 = "超出擁有金額";
        }
    }
    else{
        $error = "請輸入金額";
    }
    
}

$conn->close();
?>

<?php
include("login2.php");
echo "
	<html>
	<head>
	<title>付款</title>
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
	<h1 style='font-size: 300%; font-family:Microsoft JhengHei;'>付款</h1>
	</div>
	<h4 style = 'text-align:center;'>
	  <ul type = 'none'>
		<a href='index2.html' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>首頁</a>
		<a href='personal_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子個人錢包</a>
		<a href='common_wallet.php' style='color:white; padding: 20px; text-decoration:none;' target='_parent'>電子共用錢包</a>
		<a href='member.php' style='font-size: 100%; color:white; text-decoration:none; padding: 20px;' target='_parent'>會員個人資料</a>
		<a href='friend.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>好友</a>
		<a href='re_message.php' style='font-size: 100%; color:white; padding: 20px; text-decoration:none;' target='_parent'>訊息</a>
		
	  </ul>
	</h4>
	<br>
	";
	
	echo"<div style = 'font-size: 150%; text-align:center;'> 請輸入付款金額";
		echo "<form style = 'font-size: 100%; text-align:center;' action='' method='post'>
					<input type='text' name='money'  style = 'font-size: 80%;'>
					<br>
					";
					echo "<span style = 'color:#FF0000;font-size:100%;'>$error$error2</span>
					<br><br>
					<input type='submit' value='送出' style = 'font-size: 80%;' name='send'>
					<input type ='button' onclick='history.back()' value='回到上一頁' style = 'font-size: 80%;'>
					<br>
					</form>
				";
	echo"</div>";
echo"
	<div style = 'text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;'>

	</div>

	</body>
	</html>";
?>