<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員中心</title>
  <link rel="stylesheet" href="./css/main.css">
  <style>
    .container {
      width: 120vh;
      height: 85vh;
      color: white;
    }
    nav{
    margin: 10px 10px 10px 10px;
    padding: 25px 10px;
    text-align: center;
    color: white;
    }
    
    h2 {
      margin-bottom: 1rem;
      text-align: center;
      color: white;
      font-size: 24px;
    }

    div {
      text-align:left;
      margin-left: 20rem;
      margin-top: 1rem;
      color: black;
    }
    con{
    color: white;
    text-decoration: none;
  }
    .remove {
      
      text-align:justify;
      color: red;
    }

    .logbtn {
      margin: 0 auto;
      display: block;
      width: 15%;
      height: 5vh;
      border: none;
      background-color:black;
      color: white;
      background-size: 10%;
      outline: none;
      cursor: pointer; 
      transition: .5s;
      border-radius: 5px;
      margin-top: 5vh;
      font-size: 18px;
      text-align: center;
      font-family: sans-serif;
    }

    .inputBox{
            position: relative;
        }
    #toggle {
      position: absolute;
      transform: translateY(20%);
      width: 1.5rem;
      height: 1.5rem;
      background-size: cover;
      cursor: pointer;
      margin-left: 0.2rem;
    }

    #toggle.hide {
      background-size: cover;
    }
  </style>
</head>
<?php
include "./api/base.php"; //G: base

// $sql = "select * from `users` where acc='{$_SESSION['user']}'";
// $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC); //G: mysqli_query
$acc = $_SESSION['user'];
$data = ['acc' => $acc];
$user = find('users', $data);

?>

<body>
  <!-- G: nav -->
  <nav class="nav">
    <?php include "./layout/header.php"; ?>
    <?php include "./layout/front_nav.php"; ?>
  </nav>

  
  <!-- G: content -->
  <div class="container">
  
  <h1>會員中心</h1>
    
    <!-- <?php
    if ($_SESSION['user'] == 'admin') {
    ?>
    <a class="remove" href="remove_acc.php?id=<?= $user['id']; ?>">管理者進行刪除帳號</a>
    <?php
    }
    ?> -->
   

    <h2>歡迎<?= $_SESSION['user']; ?></h2>
    <!-- <h2>歡迎光臨，您今天好嗎?</h2> -->
    <div>
      <span>編號：</span>
      <?= $user['id']; ?>
    </div>
    <div>
      <span>帳號名稱：</span>
      <?= $user['acc']; ?>
    </div>
    <div class="inputBox">
      <span>密碼：
        <input type="password" placeholder="密碼" id="password" value="<?= $user['pw']; ?>">
      </span>
      <!-- G: function showHide -->
      <span id="toggle" onclick="showHide();"></span>
    </div>
    <div>
      <span>姓名：</span>
      <?= $user['name']; ?>
    </div>
    <div>
      <span>生日：</span>
      <?= $user['birthday']; ?>
    </div>
    <div>
      <span>現居地址：</span>
      <?= $user['addr']; ?>
    </div>
    <div>
      <span>e-mail：</span>
      <?= $user['email']; ?>
    </div>
    <div>
      <span>密碼提示：</span>
      <?= $user['passnote']; ?>
    </div>
<div class="con">
    <?php
    if ($_SESSION['user'] == 'admin') {
    ?>
      <a class="remove" href="remove_acc.php?id=<?= $user['id']; ?>">管理者進行刪除帳號</a>
    <?php
    }
    ?>
   </div>

    <form action="edit.php" method="post">
      <input type="hidden" name="id" value="<?= $user['id']; ?>"> <!-- G: 帶參數 -->
      <input type="submit" class="logbtn" value="更新會員資訊">
    </form>

  </div>
  <!-- G: footer -->
  <?php include "./layout/footer.php"; ?>

  <script>
    // G: 宣告password 用getelementbyid
    const password = document.getElementById('password')
    // G: 宣告toggle 用getelementbyid 
    const toggle = document.getElementById('toggle')

  </script>
  
</body>

</html>