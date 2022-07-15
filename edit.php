<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編輯會員資料</title>
  <link rel="stylesheet" href="./css/login.css">
  <style>
    
    table{
      margin: 2rem 5rem;
    }
    input{
      margin: 1rem;
    }
    .logbtn{
      margin: 10px 100px;
      width: 30%;
    }
  </style>
</head>
<body>
  <!-- G: nav -->
  <nav>
    <?php include "./layout/header.php";?>
    <?php include "./layout/front_nav.php";?>
  </nav>

  <!-- G:content -->
<div class="container">
  <h1>編輯會員</h1>
  <?php
    include_once "./api/base.php";
    // $sql="SELECT * FROM users WHERE id='{$_POST['id']}'";
    // $user=$pdo->query($sql)->fetch();
    $data = ['id' => $_POST['id']];
    $user = find('users', $data);

  ?>
  <form action="save_member.php" method="post">
    <table>
      <tr>
        <td>帳號</td>
        <td><?=$user['acc'];?></td>
      </tr>
      <tr>
        <td>密碼</td>
        <td><input type="password" name="pw" value="<?=$user['pw'];?>" required="required"></td>
      </tr>
      <tr>
        <td>名稱</td>
        <td><input type="text" name="name" value="<?=$user['name'];?>" required="required"></td>
      </tr>
      <tr>
        <td>生日</td>
        <td><input type="date" name="birthday" value="<?=$user['birthday'];?>" required="required"></td>
      </tr>
      <tr>
        <td>住址</td>
        <td><input type="text" name="addr" value="<?=$user['addr'];?>" required="required"></td>
      </tr>
      <tr>
        <td>email</td>
        <td><input type="email" name="email" value="<?=$user['email'];?>" required="required"></td>
      </tr>
      <tr>
        <td>密碼提示</td>
        <td><input type="text" name="passnote" value="<?=$user['passnote'];?>" required="required"></td>
      </tr>
    </table>
    <div>
      <input type="hidden" name="id" value="<?=$_POST['id'];?>">
      <input type="submit" class="logbtn" value="送出">
    </div>
  </form>
</div>
<!-- G: footer -->
<?php include "./layout/footer.php";?>
</body>
</html>