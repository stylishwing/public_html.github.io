<?php
$servername = "localhost";
$username = "id8277918_stylishwing";
$password = "Megassile19";
$db_name = "id8277918_wallet";
$text1 = "";
$text1_error = 1;
$text2 = "";
$text2_error = 1;
$text3 = "";
$text3_bool = 1;
$text4 = "";
$text5 = "";
$text6 = "0000-00-00";
$text7 = "";
$text7_error = 1;
$text6_error = 1;

$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST) && !empty($_POST["send"])){
    if(empty($_POST["name"])){
        $text1_error = 0;
    }else{
        $text1 = test_input($_POST["name"]);
    }
    
    if(empty($_POST["password"])){
        $text2_error = 0;
    }else{
        $text2 = test_input($_POST["password"]);
    }
    
    if(empty($_POST["CreditCardNumber"])){
        $text3_bool = 0;
    }else{
        $text3 = test_input($_POST["CreditCardNumber"]);
    }
    
    if(!empty($_POST["phonenumber"])){
        $text4 = test_input($_POST["phonenumber"]);
    }
    
    if(!empty($_POST["cell_phonenumber"])){
        $text5 = test_input($_POST["cell_phonenumber"]);
    }
    
    if(empty($_POST["birthday"])){
        $text6 = "0000-00-00";
    }else{
        $text6 = test_input($_POST["birthday"]);
    }
    
    if(empty($_POST["email"])){
        $text7_error = 0;
    }else{
        $text7 = test_input($_POST["email"]);
    }
        
    if(!empty($text1) && !empty($text2) && !empty($text3) && !empty($text7)){
        $sql = "INSERT INTO `member` (`ID`,`E_mail`,`Name`,`Password`,`CreditCardNumber`,`PhoneNumber`,`CellphoneNumber`,`Birthday`) 
        VALUES (NULL, '$text7', '$text1', '$text2', '$text3', '$text4', '$text5', '$text6')";
        
        
        if ($conn->query($sql) === TRUE) {
            echo "註冊成功";
        	echo '<meta http-equiv=REFRESH CONTENT=0;url=index.html>';
        } 
        else {
            echo "Error creating database: " . $conn->error;
        	echo '<meta http-equiv=REFRESH CONTENT=50;url=index.html>';
        }
    }
    

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$conn->close();
?>

<html>
<title>會員註冊</title>
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
        
        input[type="number"] {
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
<h1 style="font-size: 300%; font-family:Microsoft JhengHei;">會員註冊</h1>
</div>

<form style = "font-size: 150%; text-align:center;" action="" method="post">
  <br>
  姓名:
  <br>
  <input type="text" name="name" maxlength="10" style = "font-size: 85%;" value="<?php echo $text1;?>">
  <br>
  <?php if($text1_error == 0){
    echo "<span style = 'color:#FF0000;font-size:100%;'>*請輸入姓名</span><br />";
  }?>
  <br>
  密碼:
  <br>
  <input type="password" name="password" maxlength="20" style = "font-size: 85%;" value="<?php echo $text2;?>">
  <br>
  <?php if($text2_error == 0){
    echo "<span style = 'color:#FF0000;font-size:100%;'>*請輸入密碼</span><br />";
  }?>
  <br>
  信用卡卡號:
  <br>
  <input type="text" name="CreditCardNumber" maxlength="16" pattern="[0-9]{16}" title="16個數字" style = "font-size: 85%;" value="<?php echo $text3;?>" >
  <br>
  <?php if($text3_bool == 0){
    echo "<span style = 'color:#FF0000;font-size:100%;'>*請輸入信用卡卡號</span><br />";
  }?>
  <br>
  E-mail:
  <br>
  <input type="text" name="email" style = "font-size: 85%;" value="<?php echo $text7;?>">
  <br>
  <?php if($text7_error == 0){
    echo "<span style = 'color:#FF0000;font-size:100%;'>*請輸入E-mail</span><br />";
  }?>
  <br>
  電話:
  <br>
  <input type="text" name="phonenumber" maxlength="10" style = "font-size: 85%;" value="<?php echo $text4;?>">
  <br><br>
  手機電話:
  <br>
  <input type="text" name="cell_phonenumber" maxlength="10" style = "font-size: 85%;" value="<?php echo $text5;?>">
  <br><br>
  生日:
  <br>
  <input type="date" name="birthday" style = "font-size: 100%;" value="<?php echo $text6;?>">
 
  <br><br><br>
  <input type="submit" value="送出" style = "font-size: 85%;" name="send">
  <input type ="button" onclick="history.back()" value="回到上一頁" style = "font-size: 85%;">
</form> 
<br>

<div style = "text-align:center; background-color:MediumSeaGreen; color:white; padding:1em;">

</div>

</body>
</html>
