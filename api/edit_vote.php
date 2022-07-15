<!-- G:vote saving-->
<?php
include_once "base.php";//G: 引入base檔

$subject_id=$_POST['subject_id'];
$new_subject=$_POST['subject'];

$subject=find('subjects',$subject_id);
$subject['subject']=$new_subject;
$subject['type_id']=$_POST['types'];

save('subjects',$subject);//G: call save function

$opts=all("options",['subject_id'=>$subject_id]);//G: 引入資料表內原有的選項

  foreach($_POST['option'] as $key => $opt){
    $exist=false;
    foreach($opts as $ot){
      if($ot['id']==$key){
        $exist=true;
        break;
      }
    }

    if($exist){//G:判斷是T就更新 F就新增 還有保留
      $ot['option']=$opt;
      save("options",$ot);
    }else{
      if($opt!=""){//G:避免沒有
      $add_option=[
        'option'=>$opt,
        'subject_id'=>$subject_id
      ];
      save("options",$add_option);
    }
  }
  }

to('../back.php');

?>

