<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員登入</title>
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
  #a1{
  text-align: center;
  }
  .logbtn{
    padding: 10px 10px;
    margin: 45px 280px;
    color: white;
    width: 110px;}

</style>
<body>
  <!-- G: nav -->
<nav>
    <?php include "./layout/header.php";?>
</nav>
  <!-- G: content -->
<div class="container">
<form action="chklogin.php" method="post">

<h1>帳號登入</h1>
  <?php
  if(isset($_GET['error'])){//G: 如果錯誤的話顯示error
    ?>
    <h2 style="color: red;"><?=$_GET['error'];?></h2>
<?php
  }
  ?>
  
  <div class="txtb">
      <input type="text" name="acc">
      <span data-placeholder="帳號"></span>
    </div>

    <div class="txtb">
      <input type="password" name="pw">
      <span data-placeholder="密碼"></span>
    </div>

    <div id="a1">
      <input type="submit" class="logbtn" value="登入">
    </div>

    <div class="bottom-t">
      <a href="register.php">會員註冊</a>
      <a href="forgot.php">忘記密碼</a>
    </div>

  </form>
</div>
<!-- G: footer -->
<?php include "./layout/footer.php";?>
</body>

</html>