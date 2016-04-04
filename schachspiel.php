<!DOCTYPE html>
<html>
	<head>
		<title>Schach</title>
		<link rel="stylesheet" href="schach.css"/>
		<meta charset="utf-8">
	</head>
	<body>
	<?php
	include ('funktion.php');
	include('brett.php');
	
	$spieler = array('weiss','schwarz');
	$zuege = 0;
	
	if(isset ($_GET['auswahl'])){
		if($_GET['auswahl'] == 'Ja'){
			$schachbrett = unserialize(base64_decode(liesDatei()));
		}else{
			unlink('spielstatus.txt');
		}
	}
	
	if(isset($_GET['Von']) && isset($_GET['Nach'])){
		$zuege = $_GET['zugnummer']++;
		$nachZeile = 9-(substr($_GET['Nach'],0,1));
        $nachSpalte = (ord(substr($_GET['Nach'],1,1))-64);
        $vonZeile = 9-(substr($_GET['Von'],0,1));
        $vonSpalte = (ord(substr($_GET['Von'],1,1))-64);
		echo"<header>Es ist Spieler ".$spieler[$zuege%2]." an der Reihe</header>";
		//$schachbrett = unserialize(base64_decode($_GET['transport'])); --> Version, die über die URL geschickt wird
		$schachbrett = unserialize(base64_decode(liesDatei()));
		$schachbrett[$nachZeile][$nachSpalte] = $schachbrett[$vonZeile][$vonSpalte];
		$schachbrett[$vonZeile][$vonSpalte] = '&nbsp;';
		
	}
	$neuesSchachbrett = base64_encode(serialize($schachbrett));
	
	// Wegschreiben von $neuesschachbrett in andere Datei
		$spielstatus = fopen('spielstatus.txt',"w");
		fwrite($spielstatus,$neuesSchachbrett);
		fwrite($spielstatus, ',');
		fwrite($spielstatus,$zuege);
		fclose($spielstatus);
		unset($spielstatus);
		
	brettzeichnen($schachbrett);
	?>
		<div id="eingabebereich">
		<form action="" method="GET">
			<label>Von</label>
			<select name="Von" size="5">
			<?php
			for($spalte='A'; $spalte<='H'; $spalte++){
				for($zeile='1'; $zeile<='8'; $zeile++){
					echo"<option value='$zeile$spalte'>$spalte$zeile</option>";
				}
			}
			?>
			</select>
			<label>Nach</label>
			<select name="Nach" size="5">
			<?php
			for($spalte='A'; $spalte<='H'; $spalte++){
				for($zeile='1'; $zeile<='8'; $zeile++){
					echo"<option value='$zeile$spalte'>$spalte$zeile</option>";
				}
			}
			?>
			</select><br>
			<input type="hidden" name="zugnummer" value="<?php $zuege++; echo $zuege; ?>">
			<!--input type="hidden" name="transport" value="<?php echo $neuesSchachbrett; ?>"-->
			<input type="submit" value="Figur bewegen">
		</form>
	</body>
</html>
