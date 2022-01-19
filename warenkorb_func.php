<?php

// Code Module für Windmann Laubblaeser von Cedric

// Für Warenkorb-Sessions

function initWarenkorb($products) {

  if(!array_key_exists("warenkorb", $_SESSION)) {
    $_SESSION["warenkorb"] = new warenkorb($products);
    echo "Debug: Neuer Warenkorb erstellt<br/>";
  }
  return $_SESSION["warenkorb"];
}

function validInteger($num) {
  if(!is_numeric($num) && !is_int($num + 0)) {
    return false;
  }
  return true;
}

function legalIntSize($int, $min, $max) {
  if(($int >= $min) && ($int <= $max)) {
    return true;
  }
  return false;
}

// Warenkorb Objekt

class Warenkorb {

  // Attribute

  private $inhalt;
  private $products;

  // Konstruktor

  public function __construct($products) {
    $this->inhalt = array();
    $this->products = $products;
  }

  // Warenkorb manipulieren

  public function add($id, $qnty) {
    if($this->isValidProductAndQuantity($id, $qnty)) {
      if(array_key_exists($id, $this->inhalt)) {
        $this->inhalt[$id] += $qnty;
      }else{
        $this->inhalt[$id] = $qnty;
      }
    }

  }

  public function remove($id, $qnty) {
    if($this->isValidProductAndQuantity($id, $qnty) && array_key_exists($id, $this->inhalt)) {
      if($this->inhalt[$id]-$qnty > 0) {
        $this->inhalt[$id] -= $qnty;
      }else{
        unset($this->inhalt[$id]);
      }
    }
  }


  // Sonstige Methoden

  private function isValidProductAndQuantity($id, $qnty) { // gültige ID und Mengenangabe
    if(array_key_exists($id, $this->products) && validInteger($id) && legalIntSize($qnty, 1, 10)) {
      return true;
    }
    return false;
  }

  public function sizeOf() {
    $summe = 0;
    foreach($this->inhalt as $id => $qnty) {
      $summe += $qnty;
    }
    return $summe;
  }

  public function __toString() { // Zum Testen
    $output = "";
    foreach($this->inhalt as $id => $qnty) {
      //  Warum gibt $this->products[$id] ein Array zurück?
      $output .= $this->products[$id][0]->getName().", Stückzahl: $qnty<br />";
    }
    return $output;
  }

  public function totalNetto() {
    $total = 0;

    foreach($this->inhalt as $id => $qnty) {
      $total += ($this->products[$id][0]->getCost())*$qnty;
    }
    return $total;
  }

  public function getMwst() {
    $total = 0;

    foreach($this->inhalt as $id => $qnty) {
      $total += (($this->products[$id][0]->getCost())*0.19)*$qnty;
    }
    return $total;
  }

  public function printHTML() { // pretty?
    $output = "";
    foreach($this->inhalt as $id => $qnty) {
      $output .= "		<div class='nebeneinander'>
      <div class='produkt_anzeige'>
      <img src='".$this->products[$id][0]->getImg()."' alt='Produkt1'/>

      <div class='produkt_text'>
      <div>
      <p>Produkt: ".$this->products[$id][0]->getName()."</p>

      <p>Preis: ".$this->products[$id][0]->getCost()."</p>

      </div>

      <div class='produkt_buttons'>
      <form action='warenkorb.php' method='get'>
      <label for='qnty'>Menge:</label>
      <select class='mengen_angabe' name='qnty'>";
      for ($i = 0; $i < $qnty; $i++) {
        $output .= "<option value='".($i+1)."'>".($i+1)."</option>";
      }
      $output .= "

      </select>
      <input type='hidden' name='remove' value='".$this->products[$id][0]->getId()."' />
      <input class='produkt_input' type='submit' value='Entfernen'/>
      </form>
      </div>
      </div>
      </div>
      </div>";
    }
    return $output;
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

    $pstmt = $this->conn->prepare($q); 
    $pstmt->bind_result($prodID, $modell, $netto, $details, $blaskraft, $produktbild);
    $pstmt->execute();

    $holder_array = Array();

    while ($pstmt->fetch()){
      //echo "$row[produktID] $row[modell] $row[nettopreis] $row[details] $row[blaskraft] <img src='$row[produktbild]'/> <br>";
      $holder_array[$prodID][] = new Product($prodID, $modell, $produktbild, $netto, $details);
    }

    return $holder_array;

  }

  public function buildCommentTable(){

    $html = "";

    $query = "SELECT k.Verfasser, k.Text, p.Modell FROM kommentare k LEFT JOIN produkte p ON k.ProduktID = p.ProduktID ORDER BY RAND() LIMIT ?";
    $pstmt = $this->conn->prepare($query);
    $limit = 4;
    $pstmt->bind_param("i", $limit);
    $pstmt->bind_result($verfasser, $kommentar, $modell);
    $pstmt->execute();
    $html .= "<table>";
    while($pstmt->fetch()){
      $html .= "<tr><td>$verfasser<br/><em>$modell</em></td><td>$kommentar</td></tr>";
    }
    $html .= "</table>";

    return $html;
    }

  public function buildProductDropdown(){

    $html = "";

    $query = "SELECT ProduktID, Modell FROM produkte";
    $pstmt = $this->conn->prepare($query);
    $pstmt->bind_result($prodID, $modell);
    $pstmt->execute();

    $html .= "<option value='0' selected>Alle Produkte</option>";
    while($pstmt->fetch()){
      $html .= "<option value='$prodID'>$modell</option>";
    }

    return $html;
  }

  public function postComment($bestNr, $verfasser, $prodID, $kommentar){

    $checkBestNr = $this->conn->prepare("SELECT ProduktID FROM kommentare WHERE Bestellnummer = ?");
    $checkBestNr->bind_param("i", $bestNr);
    $checkBestNr->bind_result($id);
    $checkBestNr->execute();
    if($checkBestNr->fetch()){
      return FALSE;
    }

    if($prodID == 0){
      $query = "INSERT INTO kommentare (Bestellnummer, Verfasser, Text) VALUES ($bestNr, '$verfasser', '$kommentar')";
    }else{
      $query = "INSERT INTO kommentare (Bestellnummer, Verfasser, ProduktID, Text) VALUES ($bestNr, '$verfasser', $prodID, '$kommentar')";
    }
    $pstmt = $this->conn->prepare($query);
    
    return $pstmt->execute();;
  }

}

// DTO für Produkte im Warenkorb
class Product implements JsonSerializable {

  private $id;
  private $name;
  private $img_url;
  private $cost;
  // private $qnty = 1;
  private $descr;

  public function __construct($id, $name, $img_url, $cost, $descr) {
    $this->id = $id;
    $this->name = $name;
    $this->img_url = $img_url; // Achtung Bug URL Pfad
    $this->cost = $cost;
    $this->descr = $descr;
  }

  public function jsonSerialize() {
    return array(
      "id" => $this->id,
      "name" => $this->name,
      "img_url" => $this->img_url,
      "cost" => $this->cost,
      //"qnty" => $this->qnty,
      "descr" => $this->descr
    );
  }

  public function __toString() {
    return $this->name;
  }

  // public function setQnty($int) {
  //   $this->qnty = $int;
  // }

  public function getId() {
    return $this->id;
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

  // public function getQnty() {
  //   return $this->qnty;
  // }

  public function getDescr() {
    return $this->descr;
  }


}

?>
