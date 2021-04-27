<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php echo '<meta http-equiv=REFRESH CONTENT=60;url=logout.php>'; ?>
<?php
include("login2.php");
$WalletMember = array();

if($_SESSION['E_mail'] != null){
    $sql = "SELECT uid,uname FROM wallet_relation where Manager_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and Manager_id != uid";
		$result = $conn->query($sql) or die('MySQL query error');
		while($row = $result->fetch_row()){
		    $WalletMember[$row[0]] = $row[1];
		}
}
$conn->close();
?>

<?php
include("login2.php");
$MySelect = '';
$money = $_POST["money"];

if(isset($_POST) && isset($_POST['MySelect'])) $MySelect = $_POST['MySelect'];
if(!empty($MySelect) && isset($WalletMember["$MySelect"]) && !empty($money)){
    if($_SESSION['E_mail'] != null){
        $sql = "UPDATE wallet_relation SET limit_money = $money WHERE uid = $MySelect and Manager_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')";
    }
    if ($conn->query($sql) === TRUE){
        echo '<meta http-equiv=REFRESH CONTENT=0;url=common_wallet.php>';
    }
    else {
        echo "付款失敗" . $conn->error;
    	echo '<meta http-equiv=REFRESH CONTENT=2;url=index2.html>';
    }
}
?>

<?php
include("login2.php");
echo "
	<html>
	<head>
	<title>自訂</title>
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
	<h1 style='font-size: 300%; font-family:Microsoft JhengHei;'>自訂</h1>
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
	echo"<div style = 'font-size: 150%; text-align:center;'> ";
		echo "<form style = 'font-size: 100%; text-align:center;' action='' method='post' name='NumberSelect'>
		            請選擇成員<br /><select name='MySelect' onchange='submit();' style='font-size: 100%; font-family:PMingLiU;'>
                    <option value='YourSelect'>請選擇</option>";
                    foreach($WalletMember as $nid=>$MemberName){
                    	echo '<option value="' . $nid . '"';
                    	if($MySelect == $nid) echo ' selected';
                    	echo '>' . $MemberName . '</option>';
                    }
                echo " </select><br /><br />
					請輸入欲限制的付款金額<br /><input type='text' name='money'  style = 'font-size: 80%;'>
					<br /><br />
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