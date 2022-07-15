<?php
$p="";
if(isset($_GET['p'])){
  $p="&p={$_GET['p']}";
}
$querystr="";
if(isset($_GET['order'])){
  $querystr="&order={$_GET['order']}&type={$_GET['type']}";
}

$queryfilter="";
if(isset($_GET['filter'])){
  $queryfilter="&filter={$_GET['filter']}";
}

?>
<h1>投票列表</h1>
<!-- 分類 -->
<div id="list">
  <label for="types">投票類別</label>
    <select name="types" id="types" onchange="location.href=`?filter=${this.value}<?=$p;?><?=$querystr;?>`">
      <option value="0">全部</option>
      <?php
      $types=all("types");
      foreach($types as $type){
        $selected=(isset($_GET['filter']) && $_GET['filter']==$type['id'])?'selected':'';
        echo "<option value='{$type['id']}' $selected>";
        echo $type['name'];
        echo "</option>";
      }
      ?>
    </select>
  </div>

  <!-- G: 設計投票列表 -->
    <div>
  <ul class="list">
    <li class="list-header">
      <div>主題</div>
      <!-- G:列出排序 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
      <div><a href="?order=multiple&type=desc<?=$p;?><?=$queryfilter?>">單/複選</a></div>
      <?php
      } else {
      ?>
      <div><a href="?order=multiple&type=asc<?=$p;?><?=$queryfilter?>">單/複選</a></div>
      <?php
      }
      ?>

      <!-- G:用時間進行相關排序 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
      <div><a href="?order=end&type=desc<?=$p;?><?=$queryfilter?>">問券投票期間</a></div>
      <?php
      } else {
      ?>
      <div><a href="?order=end&type=asc<?=$p;?><?=$queryfilter?>">問券投票期間</a></div>
      <?php
      }
      ?>

      <!-- G:剩餘天數進行排序 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
      <div><a href="?order=remain&type=desc<?=$p;?><?=$queryfilter?>">剩餘天數</a></div>
      <?php
      }else{
      ?>
      <div><a href="?order=remain&type=asc<?=$p;?><?=$queryfilter?>">剩餘天數</a></div>
      <?php
      }
      ?>

      <!-- G:投票人數計算 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
        <div><a href='?order=total&type=desc<?=$p;?><?=$queryfilter?>'>投票數</a></div>
      <?php
      } else {
      ?>
        <div><a href='?order=total&type=asc<?=$p;?><?=$queryfilter?>'>投票數</a></div>
      <?php
      }
      ?>
      
    </li>
    <?php
    // G:問券是否需要排序?
    $orderStr = '';
    if (isset($_GET['order'])) {
      $_SESSION['order']['col'] = $_GET['order'];
      $_SESSION['order']['type'] = $_GET['type'];

      if($_GET['order']=='remain'){
        $orderStr = "ORDER BY DATEDIFF(`end`,now()) {$_SESSION['order']['type']}";
      }else{
        $orderStr = "ORDER BY `{$_SESSION['order']['col']}` {$_SESSION['order']['type']}";
      }
    }
    // G:問券建立分頁
        
    $filter=[];
    if(isset($_GET['filter'])){
      if(!$_GET['filter']==0){
        $filter=['type_id'=>$_GET['filter']];
      }
    }
  
    $total= math('subjects','count','id',$filter);
    $div=10;

    //G:確認總頁數
    $pages=ceil($total/$div);
    $now=isset($_GET['p'])?$_GET['p']:1;
    $start=($now-1)*$div;
    $page_rows=" limit $start,$div";

    //G:取得所有投票列表
    $subjects = all('subjects',$filter, $orderStr . $page_rows); 
    foreach ($subjects as $subject) { 
      echo "<a href='?do=vote_result&id={$subject['id']}'>"; 
      echo "<li class='list-items'>";
      echo "<div>{$subject['subject']}</div>"; 

      if ($subject['multiple'] == 0) {
        echo "<div class='text-left'>單選</div>";
      } else {
        echo "<div class='text-left'>複選</div>";
      }

      echo "<div class='text-left'>"; 
      echo $subject['start'] . "~" . $subject['end'];
      echo "</div>";

      echo "<div class='text-left'>"; 
      $today = strtotime("now");
      $end = strtotime($subject['end']);
      if (($end - $today) > 0) { 
        $remain = floor(($end - $today) / (60 * 60 * 24));
        echo "倒數" . $remain . "天";
      } else { 
        echo "<span style='color:white;'>投票截止</span>";
      }
      echo "</div>";

      echo "<div class='text-left'>{$subject['total']}</div>"; 
      echo "</li>";
      echo "</a>";
    }
    ?>

  </ul>
  
    <div class="text-center">
      <?php
      if($pages > 1) {
        for($i=1;$i<=$pages;$i++){
          echo "<a href='?p={$i}{$querystr}{$queryfilter}'>&nbsp;";
          echo $i ;
          echo "&nbsp;</a>";
        }
      }

      ?>
    </div>
  
</div>