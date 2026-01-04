<?php
foreach($_POST['text'] as $id => $text){
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
        $Title->del($id);
    }else{
        $row=$Title->find($id);
        $row['text']=$text;
        $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;
        $Title->save($row);
    }

}

to("../back.php?do=title");
?>