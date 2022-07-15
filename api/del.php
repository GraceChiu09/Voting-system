<?php
include_once "base.php";

$table=$_GET['table'];
$id=$_GET['id'];
if($table=='subjects'){//G:如果table=主題要連選項一起刪除
  del($table,$id);
  del('options',['subject_id'=>$id]);
}else{
  del($table,$id);
}

to("../back.php");
?>