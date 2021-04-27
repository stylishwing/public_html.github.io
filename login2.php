<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$servername = "localhost";
$username = "id8277918_stylishwing";
$password = "Megassile19";
$db_name = "id8277918_wallet";

$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
    die("無法對資料庫連線");
} 
?>