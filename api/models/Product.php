<?php
  class Product {
    private $conn;
    // product properties
    public $id;
    public $category_id;
    public $name;
    public $description;
    // connect db
    public function __construct($conn) {
      $this->conn = $conn;
    }
    // read data
    public function getAll() {
      $sql = "SELECT * FROM products";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt;
    }
    // show data
    public function find() {
      $sql = "SELECT * FROM products WHERE id=:id LIMIT 1";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id', $this->id);
      $stmt->execute();
      return $stmt;
    }
  }
?>