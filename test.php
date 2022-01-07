<?php

include("warenkorb_func.php");

// Test Produkt-Objekt

$testBlaeser = new Product(1, "WM 2500", "images/wm_2500.jpg", 100, "Blablabla");
echo "Testbläser Bild-URL: ".$testBlaeser->getImg()."<br />";
echo "in JSON: ".json_encode($testBlaeser)."<br />";
echo "Datentyp: ".gettype($testBlaeser)."<br />";

// Test DB connector und Produkt-Array

$windDB = new WindmannDBconnector("localhost", "root", "", "windmann");

$allProducts = array();

if($windDB->connect()) {
  $allProducts = $windDB->fetchProducts();
}

echo "Anzahl Produkte aus DB: ".count($allProducts)."<br /><br />";


if($allProducts) {
  array_walk($allProducts, function ($product) {
    //echo json_encode($product)."<br /><br />";
  });
}

echo "Hole Produkt mit id 1: ".$allProducts["1"][0]."<br/>";

// Test Warenkorb mit test.php?add=xqnty=x

session_start();

$warenkorb = initWarenkorb($allProducts);

if(array_key_exists("add", $_GET) && array_key_exists("qnty", $_GET)) {
  $warenkorb->add($_GET["add"], $_GET["qnty"]);
}

if(array_key_exists("remove", $_GET) && array_key_exists("qnty", $_GET)) {
  $warenkorb->remove($_GET["remove"], $_GET["qnty"]);
}

echo "<br /><br />";

echo $warenkorb;

echo "<br /><br />";

echo "Größe des Warenkorbs: ".$warenkorb->sizeOf()." Produkt(e)<br />";
echo "Summe in €: ".$warenkorb->total()."<br/>";
echo $warenkorb->printHTML();

?>
