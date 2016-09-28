<?php
// 變數初始值設定部份
session_start();
require "Ch06-08.inc.php";

//用 $_GET[replay] 判斷玩家是否按下 『重玩一次』 的超連結
//如果是, 則重新設定等級
if(isset($_GET['replay']) && $_GET['replay']==1){

  //Session 的 level 變數紀錄本 Session 玩到第幾關
  $_SESSION['level']=1;

  //Cookie 的 level 變數紀錄上次玩到第幾關, 只要 Cookie 未到期,
  //使用者上站就可以從上次過關的地方開始玩起
  setcookie("level",1,time()+7*86400);
}

if(isset($_SESSION['level']))
  $level=$_SESSION['level'];
//如果 $_SESSION['level'] 不存在, 代表登入後第 1 次進入本網頁
else if(isset($_COOKIE[level]))
  $level=$_SESSION['level']=$_COOKIE['level'];
//$_COOKIE[level] 不存在, 表示第一次玩, 或者已經過關
else{
  $level=$_SESSION['level'] = 1;
  setcookie("level", 1, time()+7*86400);
}

//---------------------- 關卡判斷部份 -------------------------------
// 如果有作答
if(isset($_POST['answer'])){

  if($Q[$level]['answer']==$_POST['answer']){

    //答對了, 便進入下一關
    $_SESSION['level'] += 1;
    $level=$_SESSION['level'];
    setcookie("level",$level,time()+7*86400);
    $tryAgain=False;

    if($level == 6){
      //全部過關, 刪除 Session 與 Cookie
      unset($_SESSION['level']);
      setcookie("level", 1, time()-10);
    }
  }
  else{  // 答錯了
    $tryAgain=True;
  }
}
else{  // 沒作答
  $tryAgain=False;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>機智問答區</title>
<style>
  div {text-align:center;border:2px solid navy;margin:3px}
  #frame {width:360px} 
</style></head>
<body>
<div id="frame">
<?php
if($level <= 5){ //如果關卡小於等於 5, 表示還沒答完, 所以顯示題目
?>
  <form action="Ch06-08.php" method="post">
    <div>親愛的 <?php echo $_SESSION['name'];?></div>
    <div><?php echo $Q[$level][$tryAgain];?></div>
    <div>第 <?php echo $level;?> 關</div>
    <div><b><?php echo $Q[$level]['question'];?></b></div>
    <div><input name="answer"></div>
    <div><input type="submit" value="送出答案">
	     <input type="reset" value="改寫答案"></div>
  </form> 
<?php
  }
  else{  //全部過關, 顯示成功的訊息
?>
  <div><?php echo $Q[6].$_SESSION['name'];?></div>
<?php
  }
?>
  <div><a href="Ch06-08.php?replay=1">重頭開始</a></div>
  <div><a href="Ch06-07.php">回會員專區</a></div>
  </div></body>
</html>