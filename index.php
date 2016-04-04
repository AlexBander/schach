<!Doctype html>
<html>
<head>
	<title>Abfrage</title>
	<meta charset="utf-8">
</head>
<body>
<?php
if(file_exists('spielstatus.txt')){
	?>
	<p>Bitte auswählen</p>
	<form action="schachspiel.php" method="GET">
	<input type="radio" name="auswahl" value="Ja">Ja
	<input type="radio" name="auswahl" value="Nein">Nein
	<input type="submit" value="Abschicken">
	</form>
<?php
}
?>
</body>
</html>
