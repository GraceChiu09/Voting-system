<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check Account</title>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/login.css">
  <style>
    .container{
  width: 70vh;
  height: 50vh;
}
h2{
  margin-top: 15vh;
}
  </style>
</head>
<body>
    <!-- G: nav -->
  <nav>
      <?php include "./layout/header.php";?>
    </nav>
    <!-- G:content -->
  <div class="container">
    
      <h1>密碼提示</h1>

      <?php
  include "./api/base.php";//G: 引入base檔

  $acc=$_POST['acc'];

  $sql="SELECT * FROM `users` WHERE `acc`='$acc'";//G: 尋找acc相符

  $user=$pdo->query($sql)->fetch();


  if(empty($user)){//G: 無帳號的話給查無此帳號
    echo "查無此帳號!";
  }else{
    echo "<h2>您的密碼提示為:".$user['passnote']."</h2>";
  }
  ?>
  </div>
  <!-- G: footer -->
  <?php include "./layout/footer.php";?>

</body>
</html>