
<div class="cent">更新圖片</div>
<hr>

<form action="./api/date_title.php" method="post" enctype="mutipart/form-data">
    
    <table style = " width:70%; margin:auto; ">
        <tr>
            <td>標題區圖片</td>
            <td>
                <input type="file" name="img">
            </td>
        </tr>
       
        <tr>
            <td>
                <input type="hidden" name="id" vaule="<?=$_GET['id'];?>">
                <input type="submit" value="更新">
                <input type="reset" value="重置">
            </td>
            <td>
            </td>
        </tr>
    </table>
</form>