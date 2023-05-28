<?php
  class Address {
    private PDO $conn;

    public function __construct(Database $db) {
      $this->conn = $db->getConnection();
    }

    public function getAll() : array {
      $query = "SELECT * FROM addresses";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      $data = [];
      while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        $data['addresses'] = $row;
      }
      return $data;
    }
    public function findByUserId(string $userId) : array {
      $query = "SELECT ua.*, a.* FROM user_addresses AS ua 
                  JOIN addresses AS a ON ua.address_id = a.id
                  WHERE ua.user_id = :userId";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':userId', $userId);
      $stmt->execute();

      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $row;
    }
    public function find(string $id) {
      $sql = "SELECT * FROM addresses WHERE id=:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return $stmt;
    }
  }
?>