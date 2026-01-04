<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">動態文字管理</p>
    <form method="post"  action="./api/edit_ad.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="80%">網站標題</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td></td>
                </tr>
                <?php
                // if(!isset($Title)) { $Title = new DB('title'); }
                $rows=$Ad->all();
                foreach($rows as $row):
                ?>
                 <tr class="yel">

                    <td width="40%">
                        <input type="text" name='text[<?=$row['id'];?>]' vaule="<?=$row['text'];?> style'width:95%'">
                    </td>
                    <td width="30%">
                        <input type="checkbox" name="sh[]" vaule="<?=$row['id'];?>" <?=($row['sh']==1)?"checked":"";?>>
                    </td>
                    <td width="30%">
                        <input type="checkbox" name="del[]" vaule="<?=$row['id'];?>">
                    </td>

                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                        <input type="button"
                            onclick="op('#cover','#cvr','./modal/<?=$do;?>.php?table=<?=$do;?>')"
                            value="新增動態文字廣告">
                    </td>
                    <td class="cent">
                        <input type="submit" value="修改確定">
                        <input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>