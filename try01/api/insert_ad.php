<?php
include_once "db.php";


$_POST['sh']=1;

$Ad->save($_POST);
//圖片要特別處理
to("../back.php?do=ad");
//dd($_POST);


?>