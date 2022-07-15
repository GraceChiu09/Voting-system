<?php
include "./api/base.php"; //G: base

// $pw=($_POST['pw']);//G: 密碼POST
// $sql="INSERT INTO `users` (`acc`,`pw`,`name`,`birthday`,`addr`,`email`,`passnote`) 
//                     values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['birthday']}','{$_POST['addr']}','{$_POST['email']}','{$_POST['passnote']}');";

// $pdo->exec($sql);


$data = ['email' => $_POST['email'], 'addr' => $_POST['addr'] , 'acc' => $_POST['acc'],
 'birthday' => $_POST['birthday'], 'name' => $_POST['name'], 'pw' => $_POST['pw'] , 'passnote' => $_POST['passnote']];
save('users', $data, $id);


header("location:login.php");

?>

