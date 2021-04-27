<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
include("login2.php");

if(isset($_POST)){
    if(!empty($_POST["yes"])){
        if($_SESSION['E_mail'] != null){
        	$sql = "UPDATE friend SET Yes_or_No = '1' WHERE F_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and User_id = (SELECT U_id FROM message where P_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and friend.Yes_or_No = '0')";
        }
        
        if ($conn->query($sql) === TRUE) { 
            $conn->close();
            include("login2.php");
            
        	$sql = "UPDATE friend SET Yes_or_No = '1' WHERE User_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and F_id = (SELECT U_id FROM message where P_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and friend.Yes_or_No = '0')";
        	
        	if ($conn->query($sql) === TRUE){
        	    echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
        	}
        	else{
        	    echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
        	}
        } 
        else {
        	echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
        }
    }
}
$conn->close();
?>

<?php
include("login2.php");

if($_SESSION['E_mail'] != null){
		$sql = "SELECT * FROM member, friend, message where member.E_mail = '$_SESSION[E_mail]' and member.ID = friend.F_id and friend.User_id = message.U_id and member.ID = message.P_id and friend.Yes_or_No = '0' and message.t_id = '1'";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 120%;'>";
		if($row = $result->fetch_row()){
			echo "ID : $row[9]的$row[10]向你$row[15]";
			echo "<form style = 'font-size: 120%;' action='' method='post'>
					<input type='submit' value='是' name='yes' style = 'font-size: 40%;'>
					<input type ='button' onclick='history.back()' value='回到上一頁' style = 'font-size: 40%;'>
				</form> ";
				echo " <div style = 'max-width:100%;max-height:4.5%;overflow:hidden;'>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div><br>";
			$conn->close();
		}
		echo"</div>";
		include("login2.php");
		$sql = "SELECT * FROM member, friend, message, wallet_relation 
				where member.E_mail = '$_SESSION[E_mail]' and member.ID = friend.F_id and friend.User_id = message.U_id and member.ID = message.P_id and friend.Yes_or_No = '1' and wallet_relation.yes_no = '0' and wallet_relation.uid = member.ID and message.t_id = '3'";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 120%;'>";
		if($row = $result->fetch_row()){
			echo "ID : $row[9]的$row[10]向你$row[15]";
			echo "<form style = 'font-size: 120%;' action='/re_message3.php' method='post'>
					<input type='submit' value='是' name='yes' style = 'font-size: 40%;'>
					<input type ='button' onclick='history.back()' value='回到上一頁' style = 'font-size: 40%;'>
				</form> ";
				echo " <div style = 'max-width:100%;max-height:4.5%;overflow:hidden;'>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div><br>";
			$conn->close();
		}
		echo"</div>";
		include("login2.php");
		$sql = "SELECT * FROM message, member where message.t_id = '2' and member.ID = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]') and message.P_id = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]')";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 120%;'>";
		while($row = $result->fetch_row()){
			echo "ID : $row[3] &nbsp;";
			echo "名字：$row[8] ";
			echo " $row[2]<br>";
			echo " [$row[5]]<br>";
		    echo " <div style = 'max-width:100%;max-height:4.5%;overflow:hidden;'>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div><br>";
		}
		$conn->close();
		echo"</div>";
		
		include("login2.php");
		$sql = "SELECT * FROM common_message, member where common_message.ct_id = '3' and member.ID = common_message.cp_id and common_message.cc_id = (SELECT c_id FROM wallet_relation where uid = (SELECT ID FROM member where E_mail = '$_SESSION[E_mail]'))";
		$result = $conn->query($sql) or die('MySQL query error');
		echo"<div style = 'font-size: 120%; '>";
		while($row = $result->fetch_row()){
			echo "ID : $row[4] &nbsp;";
			echo "名字：$row[9] ";
			echo " $row[3]<br>";
			echo " [$row[6]]<br>";
			echo " <div style = 'max-width:100%;max-height:4.5%;overflow:hidden;'>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div><br>";
		}
		echo"</div>";
		
	}
	else{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
	}