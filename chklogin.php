<?php
include "./api/base.php";//G: base檔

$acc=$_POST['acc'];
$pw=$_POST['pw'];//G: 帳號密碼確認

// $sql="SELECT count(*) FROM `users` WHERE `acc`='$acc' and `pw`='$pw'";//尋找資料表的acc跟pw是否相符
// $chk=$pdo->query($sql)->fetchColumn();

// $error='';

// if($chk){//G: 如果資料庫有資料是Ture
//   $_SESSION['user']=$acc;//G: 記錄user是誰並傳值
//   header("location:member_center.php");// G:登入成功
// }else{
//   $error=$sql;
//   header("location:login.php?error=$error");// G: 失敗回到登入頁
// }

$data = ['acc'=> $acc,'pw'=> $pw];
$chk = find('users',$data);

if($chk){//G: 如果資料庫有資料是Ture
  $_SESSION['user']=$acc;//G: 記錄user是誰並傳值
  header("location:member_center.php");// G:登入成功
  exit();
}else{
  // $error=$sql;
  header("location:login.php?error=ACCOUNT_ERR_1");// G: 失敗回到登入頁
  exit();
}

?>