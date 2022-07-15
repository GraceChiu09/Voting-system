<?php
include_once "base.php";
// G:投票功能會先建議檢查分類與問券名稱欄位，確認是否有重覆
// G:需要更新types表, name 放入 POST帶來的name值
save('types',['name'=>$_POST['name']]); 

header("location:../back.php");
?>