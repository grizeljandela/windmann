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
					<li><a href = "service.html">Service</a></li>
					<li><a href = "community.html">Community</a></li>
					<li><a href = "impressum.html">Impressum</a></li>
					<li id="nav_highlighted"><a href = "warenkorb.html">Warenkorb</a></li>
				</ul>
			</nav>
			</div>
		</header>

	<?php
			$versandDaten = array ();

			$name_bool=$vorname_bool=$straße_bool=$hausNr_bool
			=$straße_bool=$plz_bool=$wohnort_bool=$email_bool=$telNr_bool=$kontoinhaber_bool
			=$bic_bool=$iban_bool=$agbs_bool=true;

			if(!isset($_POST['Name'])||(strlen($_POST['Name'])< 2)) {
				$name_bool=false;

			}elseif(!isset($_POST['Vorname'])||(strlen($_POST['Vorname'])< 2)){
				$vorname_bool=false;

			}elseif(!isset($_POST['Straße'])||(strlen($_POST['Straße'])< 3)){
				$strasse_bool=false;

			}elseif(!isset($_POST['Hausnummer'])||(strlen($_POST['Hausnummer'])< 1)){
				$hausNr_bool=false;

			}elseif(!isset($_POST['Straße'])||(strlen($_POST['Straße'])< 1)){
				$straße_bool=false;

			}elseif(!isset($_POST['PLZ'])||strlen($_POST['PLZ'])< 4 || intval($_POST['PLZ']) <= 0){
				$plz_bool=false;

			}elseif(!isset($_POST['Wohnort'])||strlen($_POST['Wohnort'])< 4){
				$wohnort_bool=false;

			}elseif(!filter_var($_POST['E-MAil-Adresse'], FILTER_VALIDATE_EMAIL)){
				$email_bool=false;

			}elseif(!preg_match("/^([0-9]{10})$/", $_POST['Telefonnummer'])){
				$telNr_bool=false;

			}

			$regexp = '/^[A-Z]{6,6}[A-Z2-9][A-NP-Z0-9]([A-Z0-9]{3,3}){0,1}$/i';


			if(!isset($_POST['Kontoinhaber']) || empty($_POST['Kontoinhaber']) ||strlen($_POST['Name'])< 2){
				$kontoinhaber_bool=false;
			}elseif(!preg_match($regexp, $_POST['BIC'])){
				$bic_bool=false;
			}elseif(!preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/', $_POST['IBAN'])|| empty($_POST['IBAN'])){
				$iban_bool=false;
			}elseif(!isset($_POST['AGBs'])){
				$agbs_bool=false;

			}

			if(($name_bool && $vorname_bool&&$straße_bool&&$hausNr_bool
				&&$straße_bool&&$plz_bool&&$wohnort_bool&&$email_bool&&$telNr_bool&&$kontoinhaber_bool
				&&$bic_bool&&$iban_bool&&$agbs_bool)){
				$versandDaten['Name'] = $_POST['Name'];
				$versandDaten['Vorname'] = $_POST['Vorname'];
				$versandDaten['Straße'] = $_POST['Straße'];
				$versandDaten['Hausnummer'] = $_POST['Hausnummer'];
				$versandDaten['Plz'] = $_POST['PLZ'];
				$versandDaten['Wohnort'] = $_POST['Wohnort'];
				$versandDaten['E-Mail-Adresse'] = $_POST['E-MAil-Adresse'];
				$versandDaten['TelefonNr'] = $_POST['Telefonnummer'];
				$versandDaten['Kontoinhaber'] = $_POST['Kontoinhaber'];
				$versandDaten['BIC'] = $_POST['BIC'];
				$versandDaten['IBAN'] = $_POST['IBAN'];
				$versandDaten['agbs'] = $_POST['AGBs'];
			}

	?>
 
	<!-- Content -->
	<main class="content">
			<div class="titel_versandadresse">
				<img src="images/versandadresse.jpg" alt="Versandadresse"/>
				<h1>Versandadresse</h1>
			</div>
			<form id="formular" action="versandadresse.php" method="post">
		<div class="all_inclusiv">
			<label class="label_versand" for="Name"> Name</label>
				<input class ="versand_input" type="text" id="Name" name="Name" autofocus required/>
				<br />
				<label class="label_versand" for="Vorname"> Vorname</label>
				<input class ="versand_input" type="text" id="Vorname" name="Vorname" required />
				<br />
				<label class="label_versand" for="Strasse"> Straße</label>
				<input class ="versand_input" type="text" id="Strasse" name="Straße" required />
				<br />
				<label class="label_versand" for="Hausnummer"> Hausnummer</label>
				<input class ="versand_input" type="number" id="Hausnummer" name="Hausnummer" required />
				<br />
				<label class="label_versand" for="Adresszusatz"> Adresszusatz</label>
				<input class ="versand_input" type="text" id="Adresszusatz" name="Adresszusatz" />
				<br />
				<label class="label_versand" for="PLZ"> PLZ</label>
				<input class ="versand_input" type="number" id="Plz" name="PLZ" min="3" required />
				<br />
				<label class="label_versand" for="Wohnort"> Wohnort</label>
				<input class ="versand_input" type="text" id="Wohnort" name="Wohnort" required />
				<br />
				<label class="label_versand" for="E-MAil-Adresse"> E-Mail</label>
				<input class ="versand_input" type="email" id="Mail" name="E-MAil-Adresse" required />
				<br />
				<label class="label_versand" for="Telefon"> Tel.Nummer</label>
				<input class ="versand_input" type="number" id="Telefon" name="Telefonnummer" min="4" max ="20" required />
				<br />
			<h2>Zahlungsart</h2>
			<h3>Lastschriftmandat</h3>

				<div class="konto">
						<label class="label_versand" for="Kontoinhaber"> Kontoinhaber</label>
						<input class ="versand_input" type="text" id="Kontoinhaber" name="Kontoinhaber"  >
						<br />
						<label class="label_versand" for="BIC"> BIC</label>
						<input class ="versand_input" type="text" id="Bic" name="BIC"  />
						<br />
						<label class="label_versand" for="IBAN"> IBAN</label>
						<input class ="versand_input" type="text" id="Iban" name="IBAN" />
						<br/>
						<input type="checkbox" id="AGBs" name="AGBs"  />
						<label for="AGBs"> Ich akzeptiere die genannten Datenschutzbedingungen</label>
						<br/>
				</div>



			<div class="buttons_versand">
				<input class ="versand_input" type="submit" value="Bestätigen" style="max-width:200px"/>
				<input class ="versand_input" type="reset" value="Angaben löschen" style="max-width:200px"/>
				<input class ="versand_input" type="hidden" value="debug js" onclick="return pruefeEingabe()" style="max-width:200px"/>
			</div>
		</div>
		</form>
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
		<script src="./validate.js"></script>
	</body>
</html>
