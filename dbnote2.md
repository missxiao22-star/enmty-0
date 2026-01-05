
--------------------------------------------------------------------
DB資料庫解說:

```php
session_start();
```
[輸入]


[過程]


[輸出]


[功能目標]
1.
瀏覽器與伺服器之間建立連線與初始化環境，解決http無狀態的情況，
讓瀏覽器認得使用者，session_id來判斷使用者是誰
2.

[程式流程]


--------------------------------------------------------------------

```php
date_default_timezone_set("Asia/Taipei");
```
[輸入]


[過程]


[輸出]


[功能目標]
1.
將瀏覽器與伺服器時間調整至指定的國家及區域
2.
初始設定為格林威治時區，與台灣相差8小時的時差，使用方法將使用者的時區調整為當地準確時間
[程式流程]


--------------------------------------------------------------------

```php
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
```
[輸入]


[過程]


[輸出]


[功能目標]
1.
構造一個接收資料除錯的萬用函數，並使用指定標籤及陣列格式印出在瀏覽器上
2.
開發過程中快速檢視變數結構，用於快速除錯
[程式流程]


--------------------------------------------------------------------

```php
function q($sql){
    $dsn='mysql:host=localhost;dbname=db01;charset=utf8';
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
```
[輸入]


[過程]


[輸出]


[功能目標]
構造一個萬用Q方法，
連線初始化設定
連線條件:本地=本地端，資料庫名稱，字元編碼utf8
輸出 pdo連線用sql並抓取所有資料，使用關室陣列印出
在每次需要連線初始化時不用再次重打方法內的程式碼

[程式流程]



--------------------------------------------------------------------

```php
function to($url){
    header("location:".$url);
}
```
[輸入]


[過程]


[輸出]


[功能目標]
1.
構造一個萬用to方法，當需要指定跳轉連線時可以使用
2.
利用http標頭重新導向功能，強制跳轉到指定的網址
[程式流程]


--------------------------------------------------------------------

```php
class DB{
private $dsn="mysql:host=localhost;dbname=db01;charset=utf8";
private $pdo;   
private $table;
}
```
[輸入]


[過程]


[輸出]


[功能目標]
1.
構造一個class DB，初始化連線設定，目的為每次呼叫DB與使用方法時不用重新連線
2.

[程式流程]


--------------------------------------------------------------------

```php
function __construct($table){
    $this->table=$table;
    $this->pdo=new PDO($this->dsn,"root",'');
}
```
[輸入]


[過程]


[輸出]


[功能目標]
1.
構造一個建構子方法，當連線時需要用到建構子與pdo之間做溝通時，不用重複撰寫，並能將指定的資料表名稱存進物件本身，準備之後可以呼叫使用
2.
初始化建構子，當建立一個新的DB則會自動執行此方法且連線pdo/table儲存的值，準備好$this屬性，方便之後直接呼叫使用
[程式流程]


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


[過程]


[輸出]


[功能目標]
構建一個all方法可以用來查詢存取所有資料，並將語法轉變成sql能懂得字串格式，並最後再輸出成關聯陣列格式

[程式流程]


--------------------------------------------------------------------

```php
// select count(*) from 'admin' where `acc` = 'admin'; 
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
    // fetchColumn 回傳數字
}
```
[輸入]


[過程]


[輸出]


[功能目標]
1.
構造一個count方法，用來查詢每一筆資料有多少筆，並輸出一筆資料，型態為數字
2.
[程式流程]

 
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


[過程]


[輸出]


[功能目標]
1.
構造一個find方法，用來查詢資料的id是否存在，
2.
查詢使用者的帳號(id)是否存在
[程式流程]


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


[過程]


[輸出]


[功能目標]
1.
構造一個save方法，用來存取帶入的所有型態資料(通常是陣列格式)，並同步存進資料庫
2.
當傳入的值有主鍵則"更新"資料到資料表內
當傳入的值沒有主鍵則"新增"資料到資料表內
[程式流程]


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


[過程]


[輸出]


[功能目標]
1.
構造一個del方法，用來刪除資料庫內指定row資料，
2.

[程式流程]


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


[過程]


[輸出]


[功能目標]
1.
購造一個私有狀態的arraytosql方法，用來處理陣列資料要轉換成sql語法此重複動作
2.
將$_POST抓取到的陣列資料轉變為sql語法
[程式流程]


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


[過程]


[輸出]


[功能目標]
1.
實例化DB，並接收指定的資料表資料
2.
透過實例化物件，讓PHP程式碼以簡潔程式碼與資料庫進行通訊
[程式流程]


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


[過程]


[輸出]


[功能目標]
1.
判斷查詢瀏覽器是否有session visit字串標籤，使用物件查詢若有就等於1若沒有就+1，再次判斷時瀏覽器若有帶著visit標籤則不做任何事，並將當前session狀態使用物件存取在$t變數
2.
判斷來訪者是否第一次來訪，且在不關閉瀏覽器的前提下不重複計算
使用物件查找來訪者瀏覽器是否有visit字串標籤，若沒有則在進站總人數上+1，若有則賦值一個數字1，以便之後不重複計算
[程式流程]

