<?php

class Contador {
  private $conn;

  // Constructor que acepta una conexión a la base de datos
  public function __construct($conn) {
    $this->conn = $conn;
  }

  // Incrementa el contador de visitas para un artículo
  public function incrementarVisitas($id) {
    $sql = "UPDATE v_articulos SET visitas = visitas + 1 WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }

  // Obtiene el número de visitas para un artículo
  public function obtenerVisitas($id) {
    $sql = "SELECT visitas FROM v_articulos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['visitas'];
  }  
  public function obtenerTotalVisitas() {
    $sql = "SELECT SUM(visitas) AS total_visitas FROM articulos";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total_visitas'];
  }
}














