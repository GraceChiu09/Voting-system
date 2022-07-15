<!-- G: vote改變之後存入資料庫 -->
<?php
include_once "base.php";//G:資料庫連線

$subject=$_POST['subject'];//G:接收表單POST的內容傳值
//G: 建立資料庫內容 欄位變數等
$add_subject=[
  'subject'=>$subject,
  'type_id'=>$_POST['types'],
  'multiple'=>$_POST['multiple'],
  'start'=>date("Y-m-d"),
  'end'=>date("Y-m-d",strtotime("+10 days")),
];

//G:儲存問券
save('subjects',$add_subject);
// G:取得投票功能內的資料庫內此筆儲存檔案的id
$id=find('subjects',['subject'=>$subject])['id'];

if(isset($_POST['option'])){
  foreach($_POST['option'] as $opt){
    if($opt!=""){//G:確認有增加選項
      $add_option=[
        'option'=>$opt,
        'subject_id'=>$id
      ];  
      save("options",$add_option);
    }
  }
}

to('../back.php');

?>

