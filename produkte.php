
<!DOCTYPE html>

<html lang="de">

	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 700px)" href="style_mobil.css"/>
		<link rel="icon" href="images/logo.png">
		<title>Windmann Laubbläser</title>
	</head>


	<?php 

		require_once ("connection.php");

		$q = "SELECT * FROM produkte";

		$result = $conn->query($q);

		$holder_array = Array();

		while ($row=$result->fetch_assoc()){
			//echo "$row[produktID] $row[modell] $row[nettopreis] $row[details] $row[blaskraft] <img src='$row[produktbild]'/> <br>";
			$holder_array[] = $row;
		}

		$json_array = json_encode($holder_array);
		//var_dump($json_array);   String JSON Array von Objekte, diese Objekte sind assoziative Arrays

		file_put_contents("products.json", $json_array);

	?>


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
					<img src="images/logo.png" width="100px" height="100px" alt="Logo von Windmann"/>
					<h1>WINDMANN</h1>
					<h2>Wissen, woher der Wind weht</h2>
				</div>
			<nav>
				<ul>
					<li><a href = "index.html">Home</a></li>
					<li id="nav_highlighted"><a href = "produkte.php">Produkte</a></li>
					<li><a href = "service.html">Service</a></li>
					<li><a href = "community.html">Community</a></li>
					<li><a href = "impressum.html">Impressum</a></li>
					<li><a href = "warenkorb.html">Warenkorb</a></li>
				</ul>
			</nav>
			</div>
		</header>


		<!--Filterleiste-->
		<main class="content">

			<div id="sortierung">
				<label>Sortieren nach:</label>
				<select class="sort-select">
					<option value="Preis aufsteigend">Preis aufsteigend</option>
					<option value="Preis absteigend">Preis absteigend</option>
					<option value="Blaskraft aufsteigend">Blaskraft aufsteigend</option>
					<option value="Blaskraft absteigend">Blaskraft absteigend</option>
				</select>
			</div>


			<div class="produkte-frame"></div>
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
	
		<script src="sort_products.js"></script>
		<script src="app.js"></script>
	</body>

</html>
