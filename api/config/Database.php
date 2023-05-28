<?php
    class Database {
      // method to connect to database
      public function __construct(  
        private string $servername,
        private string $dbName,
        private string $username,
        private string $password
      ) {}

      public function getConnection() : PDO {
        try {
          $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
      }
    }
?>