<?php
include_once "db.php";

// 資料哪來的????
//從modal/title.php，選擇圖片輸入文字，點擊新增後要傳到insert.php此檔案
if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/{$_FILES['img']['name']}");
    $_POST['img']=$_FILES['img']['name'];
}
$Title->save($_POST);
//圖片要特別處理
to("../back.php?do=title");
//dd($_POST);


?>