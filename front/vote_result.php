<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員投票頁面</title>
  <link rel="stylesheet" href="./css/login.css">
  <style>
    .container{
             width: 100vh;
             text-align: center;
    }
   .logbtn{
            width: 20%;
            height: 60px;
            margin-top: 2rem;
            text-align: center;
}
    /* .nav{
        text-align: left;
      } */
  </style>
</head>
<body>   
    
<nav class="nav">
    <?php include "./layout/header.php";?>
</nav>

  
<div class="container">

<?php
$subject=find("subjects",$_GET['id']);
$opts=all("options",['subject_id'=>$_GET['id']]);
?>

<h1 class="text-center"><?=$subject['subject'];?></h1>

<div style="width: 600px;margin:auto;text-align:center;">
  <div style="text-align:center; margin:2rem;font-size: 18px;color:white;">目前投票數:<?=$subject['total'];?></div>
  <table class="result-table">
    <tr>
      <td>選項</td>
      <td>投票數</td>
      <td>比例</td>
    </tr>
    <?php
    foreach($opts as $opt){
      $total=($subject['total']==0)?1:$subject['total'];
      $rate=$opt['total']/$total;
    ?>
    <tr>
      <td><?=$opt['option'];?></td>
      <td><?=$opt['total'];?></td>
      <td>
        <!-- G:簡易分析圖表 -->
        <div style="display:inline-block;height:24px;background-color:yellow;width:<?=300*$rate;?>px;"></div>
        <?=number_format($rate*100) . "%";?>
      </td>
    </tr>
    <?php
    }
    ?>
  </table>

   <!-- G: 會員需要登入能夠投票 -->
  <?php
    if (isset($_SESSION['user'])) {
    ?>
    
          <button class="logbtn" onclick="location.href='?do=vote&id=<?=$_GET['id'];?>'">會員投票</button>
    <?php
    }else{
      ?>

    <div>
         <a href="login.php"><input type="submit" class="logbtn" value="請登入"></a>
    </div>
    <?php
    }
    ?>
</div>

</body>
</html>