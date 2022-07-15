<?php
include_once "./api/base.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABC問卷系統</title>
  <link rel="stylesheet" href="./css/main.css">
</head>
<style>
    nav{
      color: white;
      margin: 10px 10px 10px 10px;
      padding: 10px 10px;
      font-size: 16px;

    }
</style>

<body>
<!-- 設計簡單版型置入投票列表 -->
<!-- G: nav -->
<nav class="nav">
    <?php include "./layout/front_nav.php";?>
</nav>

  <!-- G: content -->
  <div class="container">
     <div class="">
        <img src="./upload/banner07.jpg" alt="banner">
      </div>

    <?php
    //G: 網頁有給值就有會有結果
    if(isset($_GET['do'])){
      $file='./front/'.$_GET['do'].".php";
    }
    if(isset($file) && file_exists($file)){
      include $file;
    }else{
      include "./front/vote_list.php";
    }
    ?>
  </div>

  <!-- G: footer -->
  <?php include "./layout/footer.php";?>
</body>

</html>