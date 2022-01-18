
<!DOCTYPE html>
<html lang="de">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" media="screen and (max-width: 700px)" href="style_mobil.css"/>
		<title>Windmann Laubbläser</title>
		<link rel="icon" href="images/logo.png">
	</head>
	<body>
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

			<span class="bestaetigungs_bild"><img src="images/bestellbestaetigung.jpg" alt="Bestellbestaetigung"/></span>

			<div class="bestaetigungs_text">
				<h3>Vielen Dank für Ihre Bestellung!</h3>

				<p>	Bitte notieren Sie sich Ihre Bestellnummer
					<font color=#fb9a63>
					 <?php 
					 require_once ("connection.php");
					 $q ="SELECT Bestellnummer FROM bestellungen ORDER BY Bestellnummer DESC LIMIT 1";

					 $pstmt = $conn->prepare($q);
					 $pstmt->bind_result($bestnr);
					 $pstmt->execute();
					 while($pstmt->fetch()){
							echo $bestnr;
					 }
					 ?> 
					 </font>
					 für die spätere Referenz Ihrer Bestellung.</p>
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
