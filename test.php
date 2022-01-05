<?php

// Zum Testen

// Test Objekt
include("warenkorb_func.php");

$testBlaeser = new Product(1, "WM 2500", "images/wm_2500.jpg", 100, 2, "Blablabla");
echo "Testbläser Bild-URL: ".$testBlaeser->getImg()."<br />";
echo "in JSON: ".json_encode($testBlaeser)."<br />";
echo "Datentyp: ".gettype($testBlaeser)."<br />";

// Test DB connector

$windDB = new WindmannDBconnector("localhost", "root", "", "windmann");

$allProducts = array();

if($windDB->connect()) {
  $allProducts = $windDB->fetchProducts();
}

echo "Anzahl Produkte: ".count($allProducts)."<br /><br />";

if($allProducts) {
  array_walk($allProducts, function ($product) {
    echo json_encode($product)."<br /><br />";
  });
}

// Test Warenkorb mit test.php?buy=1

session_start();

$warenkorb = initWarenkorb();

if(array_key_exists("buy", $_GET) && array_key_exists($_GET["buy"], $allProducts)) {
 $warenkorb->add($_GET["buy"]);
}

echo $warenkorb;

?>
