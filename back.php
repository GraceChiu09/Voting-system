<?php include_once "./api/base.php";  // G:最開端先引入base ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投票管理中心</title>
  <link rel="stylesheet" href="./css/back.css">
</head>

<body>
  <!-- G:nav -->
  <nav>
    <?php include "./layout/header.php"; ?>
    <?php include "./layout/back_nav.php"; ?>
  </nav>

  <!-- G:content -->
  <div class="container">
    <div>
      <img src="./upload/banner05.jpg" alt="bannerb">
    </div>
    <h1>投票編輯頁面</h1>
    
    <?php
      if(isset($_GET['do'])){//G: 有do這個頁面就執行
        $file="./back/".$_GET['do'].".php";//G:導向網址
      }

      if(isset($file) && file_exists($file)){//G:判斷是否有檔案
        include $file;
      }else{
    ?>
      <button class=btn onclick="location.href='?do=add_vote'">新增投票</button><!-- G:get傳值 -->

      <div>
        <ul>
          <li class="list-header">
            <div>主題</div>
            <div>單/複選</div>
            <div>問券期間</div>
            <div>剩餘天數</div>
            <div>投票數</div>
            <div>動作</div>
          </li>
          <?php
          $subjects=all('subjects'); //G:投票列表
          foreach($subjects as $subject){//G: 使用迴圈
            echo "<li class='list-items'>";
            echo "<div>{$subject['subject']}</div>";//G: 欄位

            if($subject['multiple']==0){
              echo "<div class='text-center'>單選題</div>";
            }else{
              echo "<div class='text-center'>複選題</div>";
            }

            echo "<div class='text-center'>";//G: 區分投票開始與結束時間
            echo $subject['start']. "~" .$subject['end'];
            echo "</div>";

            echo "<div class='text-center'>";//G: 計算剩餘天數
              $today=strtotime("now");
              $end=strtotime($subject['end']);
              if(($end-$today)>0){//G:投票是否仍在進行
                $remain=floor(($end-$today)/(60*60*24));
                echo "倒數".$remain."天結束";
              }else{//G: 如果投票已經截止
                echo "<span style='color:grey;'>投票已截止</span>";
              }
            echo "</div>";

            echo "<div class='text-center'>{$subject['total']}</div>";//G: 總人數

            echo "<div class='text-center'>";//G: admin行為
            echo "<a class='edit' href='?do=edit&id={$subject['id']}'>編輯</a>";
            echo "<a class='del' href='?do=del&id={$subject['id']}'>刪除</a>";
            echo "</div>";
            echo "</li>";
          }
          ?>
          
        </ul>
      </div>

    <?php
      }
    ?>
  </div>

  <!-- 頁尾 -->
  <?php include "./layout/footer.php"; ?>
</body>

</html>