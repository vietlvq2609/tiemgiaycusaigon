<?php
  class User {
    private PDO $conn;

    public function __construct(Database $db) {
      $this->conn = $db->getConnection();
    }
    // get all users
    public function getAll() : array {
      $query = "SELECT * FROM users";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $data = [];
      while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        $data['users'] = $row;
      }
      return $data;
    }
    // find specific user by id
    public function find(string $id) : array {
      $query = "SELECT * FROM users WHERE id=:id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      return $data;
    }
    public function existed(string $email, string $phone) : bool  {
      $query = "SELECT * FROM users WHERE email=:email OR phone=:phone";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":email", $email);
      $stmt->bindParam(":phone", $phone);
      $stmt->execute();
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      return $data ? true : false;
    }
    public function create($param) : void {
      $query = "INSERT INTO users (first_name, last_name, email,  phone, password) VALUES (:first_name, :last_name, :email, :phone, :password)";
      $stmt = $this->conn->prepare($query); 
      $stmt->bindParam(":first_name", $param['first_name']);
      $stmt->bindParam(":last_name", $param['last_name']);
      $stmt->bindParam(":phone", $param['phone']);
      $stmt->bindParam(":email", $param['email']);
      $stmt->bindParam(":password", $param['password']);
      $stmt->execute();
    }
  }

?>