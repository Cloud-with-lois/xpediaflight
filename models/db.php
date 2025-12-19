<?php
    session_start();
    $sql="";
class db{
    private $username;
    private $servername;
    private $password;
    private $databasename;
    private $charset;

    function connect(){

       $this -> servername = "localhost";
       $this -> username = "root";
       $this -> password = "";
       $this -> databasename = "expediadb";
       $this -> charset = "utf8mb4";
       try {
        $dsn="mysql:host=$this->servername;dbname=$this->databasename;charset=$this->charset";
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
       }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
       }

       
    }
    function getData($sql){
      return $this->connect()->query($sql);
    }

  function getJSON($sql){
    $rst=$this->getData($sql);
    return json_encode($rst->fetchAll(PDO::FETCH_ASSOC));
  }

}
?>