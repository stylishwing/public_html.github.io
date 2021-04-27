<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
$limit_money = 0;
$cost_money = 0;
$diff_money = 0;

if($_SESSION['E_mail'] != null){
    $sql = "SELECT limit_money,cost FROM wallet_relation where uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and Manager_id != uid";
		$result = $conn->query($sql) or die('MySQL query error');
		if($row = $result->fetch_row()){
		    $limit_money = $row[0];
		    $cost_money = $row[1];
		    $diff_money = $limit_money-$cost_money;
		}
}

$conn->close();
?>

<?php
include("login2.php");
$money = $_POST["money"];
$worry = 1;

if(isset($_POST) && !empty($money)){
    if($diff_money - $money < 0){
        $worry = 0;
    }
    else{
        if($_SESSION['E_mail'] != null){
    	$sql = "UPDATE common_wallet SET c_money = c_money - $money WHERE C_id = (SELECT c_id FROM wallet_relation where uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'))";
        }
    
    
        if ($conn->query($sql) === TRUE) {
        	$conn->close();
        	include("login2.php");
        
            $sql = "UPDATE wallet_relation SET cost = cost + $money WHERE uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')";
            
        	if ($conn->query($sql) === TRUE) {
        	    $conn->close();
        	    include("login2.php");
        	    $date = date("Y/m/d");
        	    
        	    $sql = "INSERT INTO `common_message` (`CM_id`,`cc_id`,`cu_id`,`c_message`,`cp_id`,`ct_id`,`c_date`) 
        			VALUES (NULL, (SELECT c_id FROM wallet_relation where uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')), '10001', '已用共用錢包花費了$money 元', (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'), '3', '$date')";
        		
        		if ($conn->query($sql) === TRUE) {
            		echo '<meta http-equiv=REFRESH CONTENT=0;url=common_wallet.php>';
            	} 
            	else {
            		echo "付款失敗" . $conn->error;
            		echo '<meta http-equiv=REFRESH CONTENT=600;url=index2.html>';
            	}
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
?>
<?php
	echo"<div style = 'font-size: 150%;text-align:center;'> ";
	echo "限制金額：" . $limit_money . '<br />';
	echo '剩餘消費金額：' . $diff_money . '<br /><br />';
		echo "<form style = 'font-size: 100%;' action='' method='post'>
					請輸入付款金額<br /><input type='text' name='money'  style = 'display:inline-block;font-size: 80%;'><br />";?>
					<?php
					if($worry == 0){
					    echo "<span style = 'color:#FF0000;font-size:100%;'>你花費金額超過上限</span>";
					}
					?>
<?php
		echo "		<br>
					<br>
					<input type='submit' value='送出' style = 'font-size: 80%;'>
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