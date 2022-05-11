<?php

class db {
  protected $server;
  protected $username;
  protected $password;
  protected $dbname;
  protected $connection;
  protected $show_errors = TRUE;
  protected $query_closed = TRUE;
  public $query_count = 0;

  function __construct($server, $username, $password, $dbname) {
    $this->server = $server;
    $this->username = $username;
    $this->password = $password;
    $this->dbname = $dbname;
    try {
      $this->connection = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);
      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }


  function select($data, $table) {
    try {
      $stmt = $this->connection->prepare("SELECT $data FROM $table");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $data = $stmt->fetchAll();
      return $data;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function addTag($name, $tagID) {
    try {
      // prepare sql and bind parameters
      $stmt = $this->connection->prepare("INSERT INTO tags (name, tagID)
      VALUES (:name, :tagID)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':tagID', $tagID);

      $stmt->execute();

      return "New records created successfully";
    } catch(PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  }

  function addEmployee($name) {
    try {
      // prepare sql and bind parameters
      $stmt = $this->connection->prepare("INSERT INTO employee (name)
      VALUES (:name)");
      $stmt->bindParam(':name', $name);

      $stmt->execute();

      echo "New records created successfully";
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}


 ?>
