    
    
    <?php
    if (isset($_SESSION['user'])) {
      if($_SESSION['user']=='admin') {
    ?>
      <a href="back.php">管理投票</a>
      <a href="logout.php">登出</a>
      <a href="member_center.php">會員中心</a>
    <?php
    }else{
    ?>
      <a href="logout.php">登出</a>
      <a href="member_center.php">會員中心</a>
    <?php
    }
  }
    else {
    ?>
      <a href="login.php">會員登入</a>
    <?php
    }
    ?>