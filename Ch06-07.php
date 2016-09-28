<?php
session_start();

$counter=1;  // 上線次數

//如果 Cookie 的 myCounter 變數不存在, 表示使用者第 1 次上站
if( !isset($_COOKIE['myCounter']) ){
  //設定 Cookie 的 myCounter 變數值為 1, 30 天之後到期
  setcookie("myCounter", $counter, time()+30*24*3600 );
}
else{
  // 讀取 Cookie 中的計數器值
  $counter = (int)$_COOKIE['myCounter']; 
  
  if ( $_SESSION['setCounter'] == TRUE ) 
    //將計數器值加 1, 並寫入 Cookie
    setcookie("myCounter", ++$counter, time()+30*24*3600);  
}

//設定程式檢查用的變數, 避免重新整理網頁也累加上線次數
$_SESSION['setCounter']=FALSE;
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>會員專區</title></head>
<body>
  <p>歡迎 <?php echo $_SESSION['name'];?>, 
  這是您第 <?php echo $counter;?> 次登入  <br>
  以下是本站提供的會員服務  <hr>
  <a href="Ch06-08.php">機智問答</a>
</body>
</html>
