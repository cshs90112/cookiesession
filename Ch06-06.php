<?php
session_start();

//還沒介紹資料庫或檔案存取, 所以用陣列儲存帳號密碼
$valid = array("name"=>"LKK","pass"=>"lkk");
$msg = '請輸入帳號密碼';  // 顯示在網頁中的提示訊息

//檢查帳號密碼
if(isset($_POST['usrName']) and isset($_POST['usrPass'])){

  if($_POST['usrName'] == $valid['name'] &&
     $_POST['usrPass'] == $valid['pass']){

    //用 session 變數紀錄使用者名稱
    $_SESSION['name']=$_POST['usrName'];

    //登入成功就可以增加 1 次上線次數
    $_SESSION['setCounter']=TRUE;

    header('Location: Ch06-07.php');   // 進入會員區
	exit();        // 結束程式   
  }
  else  //登入錯誤, 請使用者重新輸入帳密
	$msg="請輸入正確的帳號密碼";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>使用者登入</title>
</head>
<body>
  <p><?php  echo "$msg...";  ?></p>
  <hr>
  <form action="Ch06-06.php" method="post">
      帳號：<input type="text" name="usrName" 
	               value="LKK" required><br>
      密碼：<input type="password" name="usrPass" 
	               value="lkk" required>
    <input type="submit" value="送出">
  </form>
</body>
</html>