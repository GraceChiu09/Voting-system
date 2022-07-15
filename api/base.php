<?php
session_start();
date_default_timezone_set('Asia/Taipei');

// G: 資料庫連線分為PDO或mysqli
// $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
// $pdo=new PDO($dsn, 'root', '');

// $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
// $pdo=new PDO($dsn,'root','');

// $dsn="mysql:host=localhost;charset=utf8;dbname=s1110209";
// return new PDO($dsn,'s1110209','s1110209');

function pdo(){

    // G: 依照老師的範本建立
    //local
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    return new PDO($dsn, 'root', '');

    //server220
    // $dsn="mysql:host=localhost;charset=utf8;dbname=s1110209";
    // return new PDO($dsn,'s1110209','s1110209');

}
/**G: 依照老師的範本建立
 * $table - 資料表名稱 字串型式
 * ...$arg - 參數型態
 *           1. 沒有參數，撈出資料表全部資料
 *           2. 一個參數：
 *              a. 陣列 - 撈出符合陣列key = value 條件的全部資料
 *              b. 字串 - 撈出符合SQL字串語句的全部資料
 *           3. 二個參數：
 *              a. 第一個參數必須為陣列，同2-a描述
 *              b. 第二個參數必須為字串，同2-b描述
 */

function all($table,...$arg){
    $pdo=pdo();
    
    //G: base檔建立共有的基本SQL語法
    $sql="SELECT * FROM $table ";
    
    //G: 依選項來決定進行的動作因此使用switch...case
    switch(count($arg)){
        case 1:
    
            //G:判斷陣列
            if(is_array($arg[0]) && !empty($arg[0])){
    
                //G:使用迴圈來建立暫存
                foreach($arg[0] as $key => $value){
    
                    $tmp[]="`$key`='$value'";
    
                }
    
                //G: 使用implode()來轉換陣列
                //G: 字串並和原本的$sql字串再結合
                $sql.=" WHERE ". implode(" AND " ,$tmp);
            }elseif(empty($arg[0])){
                            
            }else{
                //G:補充紀錄如果參數不是陣列直接接在原本的$sql字串
                $sql.=$arg[0];

            }
        break;
        case 2:
    
            if(!empty($arg[0])){
                //G:第一個參數必須為陣列
                //G:使用迴圈來建立條件語句的陣列
                foreach($arg[0] as $key => $value){
                    
                    $tmp[]="`$key`='$value'";
                    
                }
                
                        //G:將條件語句的陣列使用implode()來轉成字串，最後再接上第二個參數(必須為字串)
                        $sql.=" WHERE ". implode(" AND " ,$tmp) . $arg[1];
            }else{
                $sql.=$arg[1];
            }
        break;
    
        //G: 執行連線資料庫查詢並回傳sql語句執行的結果
        }
    
        //G: fetchAll()加上常數參數FETCH_ASSOC是為了讓取回的資料陣列中
        //G: 只有欄位名稱,而沒有數字的索引值
        //G:測試不行echo $sql;
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    
    }
/**依照老師範本建立
 * $table - 資料表名稱 字串型式
 * $arg 參數型態
 *      1. 陣列 - 撈出符合陣列key = value 條件的單筆資料
 *      2. 字串 - 必須是資料表的id，數字型態，且資料表有id這個欄位
 */

function find($table,$arg){
    $pdo=pdo();
    
    $sql="SELECT * FROM $table WHERE ";
        if(is_array($arg)){
    
            foreach($arg as $key => $value){
    
                $tmp[]="`$key`='$value'";
    
            }
    
            $sql.=implode(" AND " ,$tmp);
    
        }else{
    
            $sql.=" `id`='$arg'";
    
        }
    
        return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }



function del($table,$arg){
    $pdo=pdo();

    $sql="DELETE FROM $table WHERE ";
    if(is_array($arg)){

        foreach($arg as $key => $value){

            $tmp[]="`$key`='$value'";

        }

        $sql.=implode(" AND " ,$tmp);

    }else{

        $sql.=" `id`='$arg'";

    }

    return $pdo->exec($sql);
}
function math($table,$math,$col,...$arg){
    $pdo=pdo();
    
    $sql="SELECT $math(`$col`) FROM $table ";
    
        if(!empty($arg[0])){
    
            foreach($arg[0] as $key => $value){
    
                $tmp[]="`$key`='$value'";
    
            }
    
            $sql.=" WHERE " . implode(" AND " ,$tmp);
    
        }
    
        //G: 使用fetchColumn()來取回第一欄位的資料
        //G: 函式會直接回傳計算的結果出來
        return $pdo->query($sql)->fetchColumn();
    }
/**
 * G: 依照老師範本建立$url - 要導向的檔案路徑及檔名
 */

function  to($url){

    header("location:".$url);

}
/**
 * G: 依照老師範本建立$sql - SQL語句字串，取出符合SQL語句的全部資料
 */

function  q($sql){
    $pdo=pdo();
    
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

function  save($table,$arg){
    $pdo=pdo();
    $sql='';
    if(isset($arg['id'])){
        //update

        foreach($arg as $key => $value){

            if($key!='id'){

                $tmp[]="`$key`='$value'";
            }

        }
        //G: 依照老師範本建立更新的sql語法
        $sql.="UPDATE $table SET ".implode(" , " ,$tmp)." WHERE `id`='{$arg['id']}'";

    }else{
        //G: 建立insert
        $cols=implode("`,`",array_keys($arg));
        $values=implode("','",$arg);

        //G: 建立新增的sql語法
        $sql="INSERT INTO $table (`$cols`) VALUES('$values')";

    }
    //G: 依照老師範本
    return $pdo->exec($sql);

}


function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

?>