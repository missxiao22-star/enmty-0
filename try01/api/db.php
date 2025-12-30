<?php
date_default_timezone_set("Asia/Taipei");
session_start();

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
    $pdo= new PDO($dsn,'root','');
    return $pdo->query($sql->fetchAll(PDO::FETCH_ASSOC));
}

function to($url){
    header("location:$url");
}

class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
    private $pdo;
    private $table;
    
    function __consturst($table){
        $this->table=$table;
        $this->pdo= new PDO($this->dsn,'root','');
    }

    function all(...$arg){
        $sql= "SELECT *FROM $this->table";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->arraytosql($arg[0]);
                $sql=$sql." WHERE ".join(" AND ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .=$arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function count(...$arg){
        $sql= "SELECT COUNT(*) FROM $this->table";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->arraytosql($arg[0]);
                $sql=$sql." WHERE ".join(" AND ",$tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .=$arg[1];
        }
        return $this->pdo->query($sql)->fetColumn();
    }

    function find($id){
         $sql= "SELECT * FROM $this->table";

        if(is_array($id)){
            $tmp=$this->arraytosql($id);
            $sql=$sql." WHERE ".join(" AND ",$tmp);
        }else{
            $sql .= " WHERE `id` = '$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}
?>