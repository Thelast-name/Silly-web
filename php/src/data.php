<?php
class Database
{
  var $conn;
  var $field = "*";
  var $table;
  var $sql;
  var $condition;
  var $val;
  
public function __construct(){
    $this->conn = mysqli_connect(
                    "db",
                    "root",
                    "password123",
                    "65162101_db",
                    );
        if( !$this->conn ){
            die('Cannot Connect DB : '. mysqli_connect_error());
    }
    date_default_timezone_set('Asia/Bangkok');
    }
    public function select(){
      $this->sql = "SELECT {$this->field} FROM {$this->table} {$this->condition}";
      return mysqli_query($this->conn, $this->sql);
    }
    public function delete(){
      $this->sql = "DELETE FROM {$this->table} {$this->condition}";
      return mysqli_query($this->conn, $this->sql);
    }
    public function insert(){
      $this->sql = "INSERT INTO {$this->table} ({$this->field}) VALUES ({$this->val})";
      return mysqli_query($this->conn, $this->sql);
    }
    public function update(){
      $this->sql = "UPDATE {$this->table} SET {$this->val} {$this->condition}";
      return mysqli_query($this->conn, $this->sql);
    }
}
?>
