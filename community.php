<?php 
include("warenkorb_func.php");
$db = new WindmannDBconnector("localhost", "root", "", "windmann");
$db->connect();
?>

<!DOCTYPE html>

<html lang="de">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" media="screen and (max-width: 700px)" href="style_mobil.css"/>
		<link rel="icon" href="images/logo.png">
		<title>Windmann Laubbläser</title>
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
				    <img  src="images/logo.png" width="100" height="100" alt="Logo von Windmann"/>
				    <h1>WINDMANN</h1>
				    <h2>Wissen, woher der Wind weht</h2>
				</div>

			    <nav>
			    	<ul>
				    	<li><a href = "index.html">Home</a></li>
				    	<li><a href = "produkte.php">Produkte</a></li>
				    	<li><a href = "service.html">Service</a></li>
				    	<li id="nav_highlighted"><a href = "community.php">Community</a></li>
				    	<li><a href = "impressum.html">Impressum</a></li>
				    	<li><a href = "warenkorb.html">Warenkorb</a></li>
				    </ul>
			    </nav>
			</div>
		</header>

		<main class="content">

            <div id="lower_header">
                <img src="images/community.jpg" alt="Community Titelbild"/>
                <h1>Community</h1>
            </div>

            <div id="community_content">
                <p>Willkommen im Community-Bereich!<br/>
                Sie haben einen Laubbläser bei uns erworben? Dann können Sie uns hier mitteilen, ob Sie mit unserem Service und Ihrem neuen Gerät zufrieden sind.</p>
                <div class="content_left">
                    <h3>Das sagen unsere Kunden:</h3>

					<?php 
						echo $db->buildCommentTable();
					?>

                </div>

                <div class="content_right">
                    <h3>Verfasse eine Rezension!</h3>
                    <form action="" method="post" id="formular">
                        <label for="name">Name:</label><br/>
                        <input class="rezension_input" id="name" name="verfasser" type="text"><br/><br/>
                        <label for="bestnr">Bestellnummer:</label><br/>
                        <input required class="rezension_input" id="bestnr" name="bestnr" type="number" min="100" max="999"><br/><br/>
                        <label for="produkt">Produkt:</label><br/>
                        <select class="rezension_input" id="produkt" name="prodid">
							
							<?php 
								echo $db->buildProductDropdown();
							?>
                            
                        </select><br/><br/>
                        <label for="kommentar">Kommentar:</label><br/>
                        <textarea required id="kommentar" name="kommentar" class="rezension_input"></textarea><br/><br/>
                        <input required type="checkbox" id="checkbox">
                        <label for="checkbox">Ich habe die Datenschutzverordnung gelesen und bin einverstanden.</label><br/><br/>
						<input class="rezension_input" id="rezension_submit" name="submit" type="submit"><br/><br/>
						
						<?php
						if(isset($_POST['submit'])){
							$verfasser = trim($_POST["verfasser"]);
							if($verfasser === ""){
								$verfasser = "Anonym";
							}

							if($db->postComment((int)$_POST["bestnr"], $verfasser, (int)$_POST["prodid"], $_POST["kommentar"])){
								echo "Sie haben als " . $verfasser . " eine Rezension verfasst.<br/>Vielen Dank für Ihr Feedback!";
							}else{
								echo "<div style='color:red;'>Die angegebene Bestellnummer ist ungültig oder es wurde bereits eine Rezension verfasst.</div>";
							}
						}
						?>

						<div id="error"></div>
                    </form>
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

		<script src="validate_community.js"></script>
		<script src="app.js"></script>
	</body>
</html>
