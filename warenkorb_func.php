<?php

// Code Module für Windmann Laubblaeser von Cedric

// Für Warenkorb-Sessions

function initWarenkorb() {

  if(!array_key_exists("warenkorb", $_SESSION)) {
    $neu = new warenkorb();
    $_SESSION["warenkorb"] = new warenkorb();
  }
  return $_SESSION["warenkorb"];
}

function printWarenkorb() {
  if(!empty($_SESSION["warenkorb"])) {
    array_walk($_SESSION["warenkorb"], function ($value, $key) {
      echo "$key, $value Stück<br />";
    });
  }else{
      echo "Warenkorb ist leer.";
  }
}

function productIdIsValid($id) {
  // TODO...
return TRUE;
}

// Warenkorb Objekt

class Warenkorb {

  private $inhalt;

  public function __construct() {
  $inhalt = array();
}

function add($id) {
   $this->inhalt[] = $id;
}

public function __toString() {
  return (String) var_dump($this->inhalt); // zum Test
}

}

// DB Verbindungsobjekt

class WindmannDBconnector {

  private $host;
  private $user;
  private $pass;
  private $db;
  private $conn;

 public function __construct($host, $user, $pass, $db) {
   $this->host = $host;
   $this->user = $user;
   $this->pass = $pass;
   $this->db = $db;
 }

 public function connect() {
   $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

   if ($this->conn->connect_error) {
     echo "Konnte nicht mit DB verbinden";
     return false;
   }
   return true;
}

public function fetchProducts() {
  if($this->conn == NULL) {
    echo "conn ist null (Verbindung nicht hergestellt?)";
    return false;
  }

  $q = "SELECT * FROM produkte";

  $result = $this->conn->query($q);

  $holder_array = Array();

  while ($row=$result->fetch_assoc()){
      //echo "$row[produktID] $row[modell] $row[nettopreis] $row[details] $row[blaskraft] <img src='$row[produktbild]'/> <br>";
      $holder_array[] = [$row["ProduktID"] => new Product($row["ProduktID"], $row["Modell"], $row["Produktbild"], $row["Nettopreis"], 1, $row["Details"])];
  }

  return $holder_array;

}

}

// DTO für Produkte im Warenkorb
class Product implements JsonSerializable {

  private $id;
  private $name;
  private $img_url;
  private $cost;
  private $qnty;
  private $descr;

    public function __construct($id, $name, $img_url, $cost, $qnty, $descr) {
      $this->id = $id;
      $this->name = $name;
      $this->img_url = $img_url; // Achtung Bug URL Pfad
      $this->cost = $cost;
      $this->qnty = $qnty;
      $this->descr = $descr;
    }

    public function jsonSerialize() {
      return array(
            "id" => $this->id,
            "name" => $this->name,
            "img_url" => $this->img_url,
            "cost" => $this->cost,
            "qnty" => $this->qnty,
            "descr" => $this->descr
        );
    }

    public function getName() {
      return $this->name;
    }

    public function getImg() {
      return $this->img_url;
    }

    public function getCost() {
      return $this->cost;
    }

    public function getQnty() {
      return $this->qnty;
    }

    public function getDescr() {
      return $this->descr;
    }


}

 ?>
