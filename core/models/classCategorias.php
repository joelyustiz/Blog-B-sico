<?php
class Categorias{
  private $db;
  private $id;

  public function __construc(){
    $this->db = new Conexion();

  }
  public function Add(){
    $this->db->query("");
  }
  public function Edit(){

  }
  public function Delete(){

  }
  public function __destruct(){
    $this->db->close();

  }
}

 ?>
