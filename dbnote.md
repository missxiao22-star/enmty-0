輸入型態輸出型態 用甚麼工具 預期結果 驗證

我的輸入說明，有沒有包含「型態＋用途」？

我的過程說明，有沒有照順序，且每一步都說明「為什麼」？

我的輸出說明，是否讓人知道「實際會看到什麼」？

我的功能目標，是否能回答：「沒有它會少了什麼？」


1/1號 23:00

--------------------------------------------------------------------
DB資料庫解說:

```php
date_default_timezone_set("Asia/Taipei");
```

[輸入]  
函數(時區識別碼)接收一個參數，參數資料型態為字串，字串設定為國家/地區城市

[過程]  
呼叫函數，接收參數，收到參數設定時區為亞洲台北，回傳true給呼叫處函數，執行時區更改

[輸出]  
函數會回傳一個布林值給呼叫處，時區正確回傳true，錯誤回傳false

[功能目標]  
此方法為設定使用者的PHP時區及時間，因原本的初始設定為UTC格林威治標準時間，與台灣有8小時的時差
因此需要使用此方法來校正時間，將使用者的時間校正為當地的標準時間

[程式流程]
時區設定:  
程式啟動，執行此行指令  
PHP 引擎修改內部的時區設定值  
後續所有呼叫 date() 或時效相關的函式，都會根據「台北時間」計算  

--------------------------------------------------------------------

```php
session_start();
```

[輸入]  
此函數名為seesion，用於啟動開關，告訴伺服器(apache)準備處理會話功能

[過程]  
當程式碼讀到此行時，會搜尋使用者是否有session的id(session id)
，沒有就隨機產生一組唯一的字串給當下使用者使用，有則去伺服器的檔案存取處抓取資料(id)

[輸出]  
伺服器會把這個id透過cookie傳送到使用者的瀏覽器儲存，下次使用時會自動帶上id，伺服器可以直接使用此id，將資料從後台(伺服器硬碟，儲存空間)抓取相關資料

[功能目標]  
瀏覽器與伺服器之間建立連線與初始化環境，解決http無狀態的情況
，讓瀏覽器認得使用者，session_id來判斷使用者是誰

[程式流程]
會話啟動:  
伺服器檢查瀏覽器傳來的 Cookie 中是否有 PHPSESSID  
若無：在伺服器建立新檔案，並發送新 ID 給瀏覽器  
若有：根據 ID 打開伺服器上對應的檔案，將資料填入 $_SESSION 變數  

--------------------------------------------------------------------

```php
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
```

[輸入]  
此 function 接收一個參數 $array，資料型態為陣列，用來傳入需要檢視的資料。

[過程]  
程式首先輸出 `<pre>` 標籤以保留輸出格式，
接著使用 `print_r()` 顯示陣列的結構內容，
最後輸出 `</pre>` 標籤結束格式化顯示。

[輸出]  
輸出結果為顯示在瀏覽器上的格式化陣列內容。

[功能目標]  
此 function 用於開發過程中快速檢視變數結構，提升除錯效率。

[程式流程]
除錯函數:  
接收變數  
輸出 <pre> 告訴瀏覽器：「接下來的東西不要自動換行，照我給的格式排」 
print_r 展開陣列結構  
輸出 </pre> 結束格式化  

--------------------------------------------------------------------

```php
function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
    $pdo= new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
```

[輸入]  
此 function 接收一個參數 $sql， 資料型態為字串，用來傳入sql指令語法

[過程]  
宣告一個變數$dsn，裡面會放入字串型態資料
驅動類型mysql:
主機位置->本地端(localhost)
網頁字元編碼->utf8
資料庫名稱->此資料庫db01
建立一個PHP與資料庫之間的橋樑
宣告一個變數$pdo，創建一個新的pdo，將使用$dsn且帳號->root密碼->空格(暫不設定)，此過程為new PDO實例化

[輸出]  
輸出(return)，  
pdo使用query方法讀取參數$sql(執行指令)，  
從PDO資料庫裡抓取全部資料，  
且用FETCH_ASSOC此格式將傳出的資料轉換型態為關聯陣列，  
函式每次結束時則會自動銷毀，橋樑斷開，無pdo可以使用

[功能目標]  
建立萬用sql語法方法，此時建立資料庫連線狀態(本地端/資料庫/字元)，並在每次呼叫Q方法時重新連線資料庫

[程式流程]
萬用查詢Q:  
呼叫 q("SQL語句")  
建立新的 PDO 連線  
執行 SQL 並將所有結果抓取格式成陣列  
回傳陣列給呼叫處  

--------------------------------------------------------------------

```php
function to($url){
    header("location:$url");
}
```

[輸入]  
此 function 接收一個參數為字串型態($url)，，目標導向url

[過程]  
呼叫內建函數header接收一個字串參數(網址)，構造一個http響應式標頭

[輸出]  
伺服器將302狀態碼及location網址傳送給瀏覽器

[功能目標]  
利用http標頭的重新導向功能，強制跳轉，使用者會看到網址跳轉

[程式流程]
頁面導向:
執行 header("location:...")  
PHP 告訴伺服器：不要回傳 HTML 內容，改發送「跳轉指令」  
瀏覽器收到指令，立刻轉址到新頁面    

--------------------------------------------------------------------

```php
class DB{
private $dsn="mysql:host=localhost;dbname=db09;charset=utf8";
private $pdo;   
private $table;
}
```

[輸入]  
定義一個class DB類別藍圖來重複使用

[過程]  
設定狀態為私有，寫入$dsn屬性，帶入右邊的字串值，內容為(狀態/本地端/資料庫名稱/字元編碼)
設定狀態為私有，寫入$pdo屬性，連線設定
設定狀態為私有，寫入$table屬性，資料表名稱

[輸出]  
需要實例化(new DB)，才能啟動自動執行

[功能目標]  
每次使用DB時會自動帶入過程中的三個變數所協帶的值，減少之後使用方法需重複帶入

[程式流程]
DB 類別屬性與建構子
new DB('table') 觸發 __construct  
儲存資料表名稱到 $this->table  
建立 PDO 物件並儲存到 $this->pdo  
物件進入待命狀態，準備好 $this 工具箱 

--------------------------------------------------------------------

```php
function __construct($table){
    $this->table=$table;
    $this->pdo=new PDO($this->dsn,"root",'');
}
```

[輸入]  
此 function 建構子 接收一個字串參數，當class DB類別實例化時會自動執行此function 

[過程]
外部的$tablle帶的值，指定存放給table標籤(屬性)，並在下次使用時呼叫$this->$table裡的值
物件本身賦值新的PDO且接收的參數為(物件本身的dsn，帳號為root,密碼為空字串)
(因為前面Q語法的pdo會在結束函數時自動銷毀，所以這裡的pdo功能是讓pdo可以被持續使用)

[輸出]  
完成物件狀態初始化，則具備了目標資料表名稱/有效的資料庫連線

[功能目標]  
初始化建構子，當建立一個新的new DB實例化時，此方法會自動連線pdo及設定table儲存的值，確保之後的方法可以直接使用($this->table/$this->pdo)建立好的屬性

[程式流程]
DB 類別屬性與建構子
new DB('table') 觸發 __construct  
儲存資料表名稱到 $this->table  
建立 PDO 物件並儲存到 $this->pdo  
物件進入待命狀態，準備好 $this 工具箱  

--------------------------------------------------------------------

```php
function all(...$arg){
    $sql="select * from $this->table ";

    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp=$this->arraytosql($arg[0]);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            $sql .= $arg[0];
        }
    }

    if(isset($arg[1])){
        $sql .= $arg[1];
    }

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
```
[輸入]  
此function 名為all，接收一個不定長參數，將這些參數打包成名為$arg的陣列，參數型態為當下傳進的值而定  

[過程]  
宣告一個$sql變數儲存sql字串語法，目標是查找所有table裡面的欄位，  

判斷帶入的資料是否有設定且是陣列，  
宣告一個$tmp變數，外部傳入的第一個值($arg[0])帶入arraytosql方法  
，接收$arg陣列參數的第0索引值  
宣告一個$sql變數，將sql字串語句存入$sql變數內  
程式執行至此會得到此字串"SELECT * FROM table WHERE 條件1 AND 條件二($tmp)"  

如果第一個參數不是陣列而是字串，就將字串黏在SQL最後面，如果存在第二個參數，就將字串黏在SQL最後面  

[輸出]  
使用保存在當前屬性中的PDO物件方法來連線物件，執行組裝好的$sql指令  


[功能目標]  
將php中的陣列及條件字串轉換成Sql看得懂的語法  

[程式流程]
取得所有資料:  
初始 SQL 為 SELECT * FROM 資料表  
判斷第一個參數 $arg[0]：  
如果是陣列：呼叫 arraytosql 拼成 WHERE ...  
如果是字串：直接黏上去（通常是 WHERE ... 的字串）  
判斷第二個參數 $arg[1]：  
通常用來放 ORDER BY 或 LIMIT（分頁用）  
執行 query() 並 fetchAll() 回傳陣列  

--------------------------------------------------------------------

```php
function count(...$arg){
    $sql="select count(*) from $this->table ";

    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp=$this->arraytosql($arg[0]);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            $sql .= $arg[0];
        }
    }

    if(isset($arg[1])){
        $sql .= $arg[1];
    }

    return $this->pdo->query($sql)->fetchColumn();
}
```

[輸入]  
此function 名為count，接收一個不定長參數，將這些參數打包成名為$arg的陣列，參數型態為當下傳進的值而定

[過程]  
宣告一個$sql變數儲存sql字串語法，
目標是查找且算出有幾筆table裡面所有的欄位是符合條件的，

判斷帶入的資料是否有設定且是陣列，
宣告一個$tmp變數 = 物件本身->外部傳入的第一個值($arg[0])帶入arraytosql方法
，接收$arg陣列參數的第0索引值
宣告一個$sql變數，將sql字串語句存入$sql變數內
程式執行至此會得到此字串"SELECT COUNT(*) FROM table WHERE 條件1 AND 條件二($tmp)"

如果第一個參數不是陣列而是字串，就將字串黏在SQL字串最後面，如果存在第二個參數，就將字串黏在SQL字串最後面

[輸出]  
使用保存在當前屬性中的PDO物件方法來連線物件
，回傳一筆資料(數字，為符合的筆數有多少)
舉例符合的筆數有五筆，則顯示一筆資料為5
，有時會顯示字串或數字，型態不固定依照當下為主

[功能目標]  
當使用count方法時，可以準確在指定的table資料表裡面抓取相對應的資料，
並顯示符合的資料有幾筆，用數字或字串型態的數字顯示，
在乙級檢定中主要是用來判斷使用者帳號(admin)是否存在，或者分頁計算

[程式流程]
計算筆數:  
初始 SQL 為 SELECT COUNT(*) FROM 資料表  
判斷第一個參數 $arg[0]：  
如果是陣列：呼叫 arraytosql 拼成 WHERE ...  
如果是字串：直接黏上去（通常是 WHERE ... 的字串）  
判斷第二個參數 $arg[1]：  
通常用來放 ORDER BY 或 LIMIT（分頁用）  
執行 query() 並 fetColumn() 回傳數字  

--------------------------------------------------------------------

```php
function find($id){
    $sql="select * from $this->table ";
    
    if(is_array($id)){
        $tmp=$this->arraytosql($id);
        $sql=$sql." where ".join(" AND " , $tmp);

    }else{
        $sql .= " WHERE `id`='$id'";
    }
    //echo $sql;
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
```

[輸入]  
此function 名為find，接收一個參數$id
它可以是主鍵id(整數/字串)或是多個篩選條件(關聯陣列)

[過程]  
宣告一個$sql變數儲存sql字串語法，
目標是查找table裡面所有的欄位，

判斷$id帶入的資料是否為陣列，
宣告一個$tmp變數 = 物件本身外->外部傳入的值($id)帶入arraytosql方法
宣告一個$sql變數 = 將sql字串語句存入$sql變數內
程式執行至此會得到此字串"SELECT * FROM table WHERE 條件1 AND 條件二($tmp)"

如果$id參數不是陣列，會在sql字串最後面加上
程式執行至此會得到此字串"SELECT * FROM table WHERE `id` = '$id'(值)"

[輸出]  
使用保存在當前屬性中的PDO物件方法來連線物件，
使用query方法來取回接收到的$sql參數裡面的值的資料
抓取單一橫列(row)資料，並以索引陣列方式回傳顯示
若有撈到陣列資料，則會啟用FETCH_ASSOC此格式將傳出的資料轉換型態為關聯陣列
沒有撈到陣列資料則會回傳false(布林值)

[功能目標]  
情境一(修改資料):
當使用者(admin)點選編號五的編輯按鈕，程式會呼叫 $row = $DB->find(5)
，這時 $row 就是那筆資料的陣列

情境二（登入判斷）： 檢查帳號密碼，呼叫 $user = $DB->find(['acc'=>$_POST['acc'], 'pw'=>$_POST['pw']])。如果回傳不是 false，就代表帳號密碼正確

[程式流程]  
當瀏覽器請求發出時(我寫的find($_GET['id']) 這行指令執行)，PHP 引擎會先幫你把網址裡的 ?id=1 抓出來($_GET 情況下，這個 id=1 通常稱為 「URL 參數」 或 「查詢字串 (Query String)」)，塞進 $_GET['id'] 這個超全域變數裡>find 方法收到值  後，組裝成 SQL 字串，再由 PDO 送去給資料庫  
1.  當我呼叫 find(1)  
2.  程式進入 find 的 {...} 內部跑程式碼  
3.  組出 WHERE id='1'  
4.  最後才執行 query()->fetch() 從資料庫拿回結果  


重新梳理後的正確路徑（乙級實戰模型）：  
瀏覽器端：使用者點擊(修改)帶有(查找id)指令的標籤 <a href="?id=1">  
伺服器端 (PHP)：自動準備好 $_GET['id'] = 1  
你的代碼層：執行 $row = $DB->find($_GET['id'])  
方法邏輯層 (find):接收到 1  
判定不是陣列，走 else  
拼接字串：變成 SELECT * FROM table WHERE id='1'  
資料庫層 (MySQL)：接收 SQL 指令，回傳那「一列」資料給 PHP  
最終結果：$row 變成了那筆資料的關聯陣列  

--------------------------------------------------------------------

```php
function save($array){
    if(isset($array['id'])){
        //update
        $sql="update $this->table set ";
        $tmp=$this->arraytosql($array);
        $sql.= join(" , ",$tmp) . "where `id`= '{$array['id']}'";
    }else{
        //insert
        $cols=join("`,`",array_keys($array));
        $values=join("','",$array);
        $sql="insert into $this->table (`$cols`) values('$values')";
    }

    return $this->pdo->exec($sql);
}
```

[輸入]  
此function 名為save，接收一個陣列參數$array

[過程]  
宣告一個$sql變數儲存sql字串語法，
目標是儲存table裡面的新增資料(row整欄)，

判斷$array裡面的id欄位帶入的資料是否有設定，

若是$array['id']成立/true時(在資料表有資料時新增):

宣告一個$sql變數 = sql字串語法，目標新增資料到指定的table
"UPDATE $this->table SET "
宣告一個$tmp變數 = 物件本身外->外部傳入的值($array)帶入arraytosql方法
宣告一個$sql變數 = 將sql字串語句加在sql字串語句最後面
"UPDATE $this->table SET 欄位='值'"

PHP組合完成後:
"UPDATE table SET JOIN(" , ",$tmp) . "where `id`= '{$array['id']}'"
程式執行至此會得到此字串:
"UPDATE table SET acc='admin', pw='1234' WHERE id='1'"

若是$array['id']不成立/false時(資料表沒有資料時新增):

宣告一個$cols變數 = 加入sql字串語法
宣告一個$vaule變數 = 加入sql字串語法
宣告一個$sql變數 = 將sql字串語句加在sql字串語句最後面
php組合完成後:
"INSERT INTO table SET insert into $this->table (`$cols`) values('$values')"
程式執行至此會得到此字串:
"INSERT INTO table (acc,pw) VALUES ('admin','1234')"

[輸出]  
使用保存在當前屬性中的PDO物件方法來連線物件，
exec使用$sql裡面存的值(sql字串語法)，用於執行(新增/修改/刪除)動作，
並回傳受影響的筆數

[功能目標]  
執行save方法時，
當傳入的值包含主鍵時"更新"資料(資料表"有"資料時新增)
當傳入的值沒有主鍵時"新增"資料(資料表"沒"資料時新增)兩種情況下，
成功新增資料到資料表內並儲存顯示在資料庫內
，在乙級檢定中為用來新增某個會員資料，或是新增某筆公告/標頭圖片/文字..等

[程式流程]
當瀏覽器請求發出時(我寫的save($_POST['id']) 這行指令執行)，PHP 引擎會先幫你把網址裡的 ?id=1 抓出來($_POST 會抓取資料表所有資料用陣列顯示)，塞進 $_POST['id'] 這個超全域變數裡> save 方法收到值後，組裝成 SQL 字串，再由 PDO 送去給資料庫  
1.  當我呼叫 save($array)，save會得到整個資料表資料  
2.  程式進入 save 的 {...} 內部跑程式碼  
3.  組出 WHERE id='1'，得到新增或更新的sql字串執行語句  
4.  新增id='1'的欄位資料(整個row)  
5.  最後才執行 ->exec() 執行新增或更新，顯示最終結果資料  

重新梳理後的正確路徑（乙級實戰模型）：  
瀏覽器端：使用者點擊(新增)帶有(查找id)指令的標籤 <a href="?id=1">  
伺服器端 (PHP)：自動準備好 $_POST['id'] = 1  
你的代碼層：執行 $DB->save($_POST['id'])，此行在其他檔案撰寫  
方法邏輯層 (save)：  
判斷：$_POST 裡面有沒有 id？  
如果有：跑 update 語法，把舊資料蓋掉  
如果沒有：跑 insert 語法，在資料庫最後面加一橫列  
資料庫層：執行新增該筆資料    
最終結果：資料成功寫入，PHP 通常會執行 to("index.php") 叫網頁跳回原頁面，使用者看到那筆資料新增  

--------------------------------------------------------------------

```php
function del($id){
    $sql="delete  from $this->table ";
    
    if(is_array($id)){
        $tmp=$this->arraytosql($id);
        $sql=$sql." where ".join(" AND " , $tmp);

    }else{
        $sql .= " WHERE `id`='$id'";
    }
    //echo $sql;
    return $this->pdo->exec($sql);
}
```

[輸入]  
此function 名為del，接收一個參數$id
它可以是主鍵id(整數/字串)或是多個篩選條件(關聯陣列)

[過程]  
宣告一個$sql變數儲存sql字串語法，
目標是刪除table裡面的整筆欄位，

判斷$id帶入的資料是否為陣列，
宣告一個$tmp變數 = 物件本身外->外部傳入的值($id)帶入arraytosql方法
宣告一個$sql變數 = 將sql字串語句存入$sql變數內
程式執行至此會得到此字串"DELETE FROM table WHERE 條件1 AND 條件二($tmp)"

如果$id參數不是陣列，會在sql字串最後面加上
程式執行至此會得到此字串"DELETE FROM table WHERE `id` = '$id'(值)"

[輸出]  
使用保存在當前屬性中的PDO物件方法來連線物件，
exec使用$sql裡面存的值(sql字串語法)，用於執行(新增/修改/刪除)動作，
並回傳受影響的筆數

[功能目標]  
執行del方法時指定刪除該資料表內的row(整筆欄位)
，在乙級檢定中為用來刪除某個會員資料，或是刪除某筆公告

[程式流程]
當瀏覽器請求發出時(我寫的del($_GET['id']) 這行指令執行)，PHP 引擎會先幫你把網址裡的 ?id=1 抓出來($_GET 情況下，這個 id=1 通常稱為 「URL 參數」 或 「查詢字串 (Query String)」)，塞進 $_GET['id'] 這個超全域變數裡> del 方法收到值後，組裝成 SQL 字串，再由 PDO 送去給資料庫  
1.  當我呼叫 del(1)  
2.  程式進入 del 的 {...} 內部跑程式碼  
3.  組出 WHERE id='1'，得到刪除的sql字串執行語句  
4.  刪除id='1'的欄位資料(整個row)  
5.  最後才執行 ->exec() 執行刪除，顯示最終結果資料  

重新梳理後的正確路徑（乙級實戰模型）：  
瀏覽器端：使用者點擊(刪除)帶有(查找id)指令的標籤 <a href="?id=1">  
伺服器端 (PHP)：自動準備好 $_GET['id'] = 1  
你的代碼層：執行 $DB->find($_GET['id'])，此行在其他檔案撰寫  
方法邏輯層 (del)：拼接字串，變成 DELETE FROM table WHERE id='1'    
資料庫層：執行刪除，該筆資料消失  
最終結果：PHP 通常會執行 to("index.php") 叫網頁跳回原頁面，使用者看到那筆資料不見了  

--------------------------------------------------------------------

```php
private function arraytosql($array){
    $tmp=[];
    foreach($array as $key => $value){
        $tmp[]="`$key`='$value'";
    }

    return $tmp;
}
```

[輸入]  
私有狀態 此function 名為arraytosql，接收一個陣列參數$array

[過程]  
宣告一個空陣列名為$tmp
若有資料傳入實際案例為:
$tmp，裝入索引陣列帳號等於使用者名稱，密碼等於1234

迴圈foreach，$array陣列 等於 $key&$vaule，
$tmp陣列裝入foreach抓取到的$key&$vaule資料，並轉成字串$key=$vaule
若有資料傳入實際案例為:$tmp等於字串密碼=1234

[輸出]  
輸出$tmp資料為一段sql字串
例如:['acc'=>'admin'] 變成 `acc`='admin'


[功能目標]  
使用arraytosql時將$_POST抓取到的資料轉變為sql語法看得懂的字串型態

[程式流程]
接收資料：接收一個關聯陣列（例如 $array = ['acc'=>'admin', 'pw'=>'1234']）  
準備容器：準備一個空陣列 $tmp = []  
開始加工 (迴圈)：  
第一圈：抓到 Key 是 acc，Value 是 admin，組裝成字串 `acc`='admin' 並塞進 $tmp  
第二圈：抓到 Key 是 pw，Value 是 1234，組裝成字串 `pw`='1234' 並塞進 $tmp  
完工回傳：回傳 $tmp 陣列（這時它裡面長這樣：["acc='admin'", "pw='1234'"]）  

--------------------------------------------------------------------

```php
$Title=new DB('title');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$Image=new DB('image');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');
$Total=new DB('total');
$Bottom=new DB('bottom');
```

[輸入]  
實力化類別(DB)為一個物件($Title/$Ad/$Mvim...)  

[過程]  
宣告一個變數$Title=新的DB名，綁定title資料表名稱  
宣告一個變數$Ad=新的DB名，綁定ad資料表名稱  
宣告一個變數$Mvim=新的DB名，綁定mvim資料表名稱  
宣告一個變數$Total=新的DB名,綁定image資料表名稱  
宣告一個變數$News=新的DB名，綁定news資料表名稱  
宣告一個變數$Admin=新的DB名，綁定admin資料表名稱  
宣告一個變數$Menu=新的DB名，綁定menu資料表名稱  
宣告一個變數$Bottom=新的DB名，綁定bottom資料表名稱  

[輸出]  
執行完畢後，記憶體中會產生數個獨立的資料庫操作物件  

[功能目標]  
透過實例化物件，讓PHP程式碼能以簡潔的方法($Ad->all())與資料庫進行通訊  
目的是為了讓瀏覽器端的操作(新增公告/修改標題...等)能準確的寫入對應資料庫  
，且在重整頁面時抓取正確資料並顯示出來  

[程式流程]
載入藍圖：PHP 執行到此處前，必須先 include_once "DB.php"  
啟動建構子：當執行 new DB('title') 時，程式會自動跑去執行類別裡的 __construct('title')  
綁定名稱：類別內部的 $this->table 會被設定為 'title'  
建立連線：同時啟動 PDO 連線，讓這個 $Title 工具箱具備跟 MySQL 溝通的能力  
待命：此後，只要你在任何地方寫 $Title->save()，PHP 就知道要對 title 這張表做動作  

--------------------------------------------------------------------

```php
if(!isset($_SESSION['visit'])){
    //第一次來訪
    $t=$Total->find(1);
    $t['total']++;
    $Total->save($t);
    $_SESSION['visit']=1;
}
```

[輸入]  
判斷當前使用者在這次開啟瀏覽器時，是否已經被計算過進站人數 

[過程]  
如果使用者這次開啟瀏覽器，並沒有被計算過進站人數，則

宣告一個變數$t= 接收物件$Total執行->find函數回傳的陣列資料
讀取：$t = $Total->find(1) 就像是去倉庫把編號 1 的計數牌拿出來

將變數$t儲存的total資料表內的欄位total+數字1
修改：$t['total']++ 是在 PHP 記憶體裡把牌子上的數字加 1  

將total資料表修改後的($t)資料存回資料庫
寫入：$Total->save($t) 是把修改後的牌子放回資料庫  

給當前使用者一個數字1表示已計數，以防下次重複進入瀏覽器時被重複計算
關鍵點：最後一行 $_SESSION['visit']=1 是為了「發一張號碼牌給使用者」，下次他重新整頁時，第一行的 if 就會因為 isset 成立而不再執行，防止重複計算   

[輸出]  
更新資料庫中total資料表的total欄位數值，並在session中建立訪問標記 

[功能目標]  
計算總進站人數，利用session確保使用者在不關閉瀏覽器的情況下，重整網頁不重複計算  

[程式流程]
判斷session標籤是否在訪客身上，如果是第一次進站：  
呼叫 $Total->find(1)：  
數字加一：$t['total']++    
存回資料庫：$Total->save($t)  
設定標記：$_SESSION['visit']=1  
如果有（重新整理網頁）：  
略過整個 if 區塊，什麼都不做  
準備呈現：後續在網頁適當位置印出資料庫裡的數值  
除非關閉瀏覽器才會重新計算成新的來訪者  

--------------------------------------------------------------------