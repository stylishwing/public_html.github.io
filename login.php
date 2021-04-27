<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$servername = "localhost";
$username = "id8277918_stylishwing";
$password = "Megassile19";
$db_name = "id8277918_wallet";
$id = $_POST["email"];				//$id = E-mail
$pw = $_POST["password"];
$error = 1;

$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
    die("無法對資料庫連線");
} 
if(isset($_POST) && !empty($id) && !empty($pw)){
    $sql = "SELECT * FROM member where E_mail = '$id' and Password = '$pw'";
    $result = $conn->query($sql) or die('MySQL query error');
    $row = $result->fetch_row();
    
    	//判斷帳號與密碼是否為空白
    	//以及MySQL資料庫裡是否有這個會員
    	if($id != null && $pw != null && $row != null){
    		//將帳號寫入session，方便驗證使用者身份
    		$_SESSION['E_mail'] = $id;
    		echo '登入成功!';
    		echo '<meta http-equiv=REFRESH CONTENT=0;url=index2.html>';
    	}
    	else{
    		$error = 0;
        }  
}

?>

<html>
<title>會員登入</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<style>

        input[type="text"] {
            padding: 5px 15px;
            border: 2px black solid;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }


        input[type="password"] {
            padding: 5px 15px;
            border: 2px black solid;
            cursor: pointer;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }

        input[type="date"] {
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
<h1 style="font-size: 300%; font-family:Microsoft JhengHei">會員登入</h1>
</div>

<form style = "font-size: 150%; text-align:center;" action="" method="post">
  <br>
  E-mail:
  <br>
  <input type="text" name="email">
  <br><br>
  密碼:
  <br>
  <input type="password" name="password">
  <br>
  <?php if($error == 0){
      echo "<span style = 'color:#FF0000;font-size:100%;'>E-mail或密碼有誤</span>";
  }?>
  <br><br>
  <input type="submit" value="登入" style = "font-size: 85%;">
  <input type ="button" onclick="history.back()" value="回到上一頁" style = "font-size: 85%;">
  <br>
</form>

<div style = "font-size: 150%; text-align:center;">
<a href="registered.php" style="text-decoration: none">申請帳號</a>
</div>
<br>
<div style = "text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;">
</div>

</body>
</html>