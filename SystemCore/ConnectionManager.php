<?php
namespace SystemCore;

// Singleton to connect db.
class ConnectionManager {
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  
  private $host = '127.0.0.1';
  private $user = 'root';
  private $pass = '';
  private $name = 'dbuser';
  

  // The db connection is established in the private constructor.
  private function __construct()
  {
    // try{
    //   $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->name", $this->user,$this->pass);
    //   $this->$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    //   echo "Connected successfully"; 
    // }
    // catch(\PDOException $e){
    //   echo $e;
    // }

    try {
      $conn = new \PDO("mysql:host=$this->host;dbname=$this->name", $this->user, $this->pass);
      // set the PDO error mode to exception
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $this->conn = $conn;

      echo "Connected successfully"; 
      }
  catch(\PDOException $e)
      {
      echo "Connection failed: " . $e->getMessage();
      }
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectionManager();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->conn;
  }

  public function getError(){
    return $this->conn->errorInfo();
  }
}
?>