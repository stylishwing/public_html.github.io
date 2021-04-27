<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
unset($_SESSION['E_mail']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';
?>