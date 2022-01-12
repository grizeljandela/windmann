<?php
include("warenkorb_func.php");

$windDB = new WindmannDBconnector("localhost", "dienstblaeser", "dienstblaeser", "windmann");

$allProducts = array();

if($windDB->connect()) {
	$allProducts = $windDB->fetchProducts();
}

session_start();

$warenkorb = initWarenkorb($allProducts);

if(array_key_exists("add", $_GET) && array_key_exists("qnty", $_GET)) {
	$warenkorb->add($_GET["add"], $_GET["qnty"]);
	header("Location: warenkorb.php");
}

if(array_key_exists("remove", $_GET) && array_key_exists("qnty", $_GET)) {
	$warenkorb->remove($_GET["remove"], $_GET["qnty"]);
	header("Location: warenkorb.php");
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 700px)" href="style_mobil.css"/>
	<title>Windmann Laubbläser</title>
	<link rel="icon" href="images/logo.png">
</head>

<body>
	<header>
		<div class="header">

			<div class="hamburger_wrapper">
				<div class="hamburger">
					<hr id="hr-1">
					<hr id="hr-2">
					<hr id="hr-3">
				</div>
			</div>

			<div id="upper_header">
				<img src="images/logo.png" width="100" height="100" alt="Logo von Windmann"/>
				<h1>WINDMANN</h1>
				<h2>Wissen, woher der Wind weht</h2>
			</div>
			<nav>
				<ul>
					<li><a href = "index.html">Home</a></li>
					<li><a href = "produkte.php">Produkte</a></li>
					<li><a href="service.html">Service</a></li>
					<li><a href="community.php">Community</a></li>
					<li><a href="impressum.html">Impressum</a></li>
					<li id="nav_highlighted"><a href = "warenkorb.php">Warenkorb</a></li>
				</ul>
			</nav>

		</div>
	</header>

	<!-- Content -->
	<main class="content">

		<div class="titel_warenkorb">
			<img src="images/warenkorb.jpg" alt="Warenkorb"/>
			<h1>Warenkorb</h1>
		</div>
		<div class="nebeneinander">
			<div>
				<?php echo $warenkorb->printHTML(); ?>
			</div>
			<div class="produkt_summe">

				<h3>Summe (<?php echo $warenkorb->sizeOf(); ?> Artikel):</h3>
				<p>Produktpreis: <?php echo number_format($warenkorb->totalNetto(), 2, '.', ''); ?>€</p>
				<P>Versandkosten: 19,95€</p>
					<p>Mwst.: <?php echo number_format($warenkorb->getMwst(), 2, '.', ''); ?>€</p>
					<h3>Insgesamt: <?php echo ($warenkorb->totalNetto()+$warenkorb->getMwst()+19.95); ?> €</h3>
					<a href="versandadresse.html"><input class="produkt_input" type="submit" value="Bezahlen" /></a>
				</div>
			</div>
		</main>

		<!-- Fusszeile -->
		<footer>
			<div class="footer_element">
				<h5>Windmann-Seite</h5>
				<p><a href="impressum.html">Impressum</a></p>
				<p><a href="datenschutz.html">Datenschutz</a></p>
			</div>

			<div class="footer_element">
				<h5>Kontakt</h5>
				<h6><a href="mailto:service@laubblaeser.de">service@laubblaeser.de</a></h6>
				<p>Öffnungszeiten:</p>
				<p>Mo-Fr</p>
				<p>10-16 Uhr</p>
			</div>

			<div class="footer_element">
				<h5>Telefon/Fax</h5>
				<h6>Tel: 0800 912345</h6>
				<p>Fax: 0800 912346</p>
			</div>

			<div class="footer_element">
				<h5>Hilfe</h5>
				<h6><a href ="service.html">Kundenservice</a></h6>
			</div>
		</footer>
		<script src="app.js"></script>
	</body>
	</html>
