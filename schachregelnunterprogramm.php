<!DOCTYPE html>
<?php

include ('array.php');

$sv=isset($_GET['sv'])?strtolower($_GET['sv']): -1;
$zv=isset($_GET['zv'])?$_GET['zv']: -1;
$sn=isset($_GET['sn'])?strtolower($_GET['sn']): -1;
$zn=isset($_GET['zn'])?$_GET['zn']: -1;

// $zn=strtolower($_GET['sv'])??-1; // PHP 7 ?? operator


// keyword name(parameterlist)  in PHP 5.x
function zeige($uebergabe)
{
	echo "<h5>Anzeige durch Unterprogramm</h5>";
	echo "<div id='anzeige'><table>";
		foreach($uebergabe as $zeile)
		{
			echo "<tr>"	;
			foreach($zeile as $feld)
			{
				echo "<td>$feld</td>";
			}
			echo "<tr>"	;
		}
		echo "</table></div>";
}

function input_valid($_sv, $_zv,$_sn,$_zn)// :bool
{	
	echo "Prüfung auf Koordinaten, die auf dem Brett liegen<br>$_sv$_zv$_sn$_zn<br>";
		
	return ( ($_sv >= 'a') &&  ($_sv <= 'h')
		  && ($_zv >= 1  ) &&  ($_zv <=  8 )
		  && ($_sn >= 'a') &&  ($_sn <= 'h')
		  && ($_zn >= 1  ) &&  ($_zn <=  8) 
	       );
}

function real_move($_sv, $_zv,$_sn,$_zn) // :bool
{
	echo "Prüfung auf Koordinaten, die eine echte Bewegung bedeuten<br>$_sv$_zv nach $_sn$_zn<br>";		
	return ( ($_sv != $_sn) ||  ($_zv != $_zn));
}
function which_figure($spielstand, $_sv, $_zv)// :string
{	return $spielstand[9-$_zv][ord($_sv)-96];}
function vertical_move($_sv,$_sn)// :bool
{	return ($_sv==$_sn); }
function horizontal_move($_zv,$_zn)// :bool
{	return ($_zv==$_zn);}
function diagonal_move($_sv, $_zv,$_sn,$_zn)// :bool
{	return (abs((ord($_sv) - ord($_sn))) == (abs($_zv - $_zn))); }
function horse_move($_sv, $_zv,$_sn,$_zn)// :bool
{   return (abs((ord($_sv) - ord($_sn))) + (abs($_zv - $_zn)) == 3); }
?>
<html>
	<head>
		<meta charset='UTF-8'>
		<style>
			body {font-size:16px; color: rgb(0,0,0);background-color:rgb(224,224,224);}
			div {float:left;margin: 2%;border:solid rgb(128,128,128) 2px; padding:2px;}
		</style>
		
	</head>
	
    <body>
    	<h3>Die angenommene Stellung der Spielfiguren</h3>
    	<?php
    	zeige($spielstand); // keine Typüberwachung in PHP 5
    	echo "
    	<div id='form'>
    	<form>
    		<input type='text' name='sv' maxlength='1' size='1' value=$sv >
    		<input type='text' name='zv' maxlength='1' size='1' value=$zv >Von<br>
    		<input type='text' name='sn' maxlength='1' size='1' value=$sn>
    		<input type='text' name='zn' maxlength='1' size='1' value=$zn>Nach<br>
    		<input type='submit'>
    	</form>
    	</div>
    	<div id='aufDemBrett'> ";
		if(input_valid($sv,$zv,$sn,$zn)) 
		{
			echo "Eingaben sind auf dem Feld";
		}
		else {
			echo "Eingaben sind außerhalb des Feldes";
		}
		echo"</div>
		<div id='aufDemBrett'> ";
		if(real_move($sv,$zv,$sn,$zn)) 
		{
			echo "Dies ist ein echte Bewegung";
		}
		else {
			echo "Das wäre eine Bewegung auf der Stelle";
		}
		echo"</div>
		<div id='figur'>";
		$figur=which_figure($spielstand,$sv,$zv);
		if($figur != '&nbsp;') 
		{
			echo "Regelprüfung für ".$figur;
		}
		else {
			echo "Ein leeres Feld";
		}
		echo"</div>
		<div id='direction'>";
		echo vertical_move($sv,$sn)?'Ein vertikaler Zug ':'&nbsp;';
		echo horizontal_move($zv,$zn)?'Ein horizontaler Zug ':'&nbsp;';
		echo diagonal_move($sv,$zv,$sn,$zn)?'Ein diagonaler Zug ':'&nbsp;';
		echo"</div>";
		echo"<div id='rules'>";
		switch(substr($figur,4,2))
		{
			case "23":
			case "17":  $r=vertical_move($sv,$sn)?' ':' nicht';
						echo "Zug ist für einen Bauern ".$r." erlaubt";
							break;
			case "20":
			case "14":  $r=vertical_move($sv,$sn)||horizontal_move($zv, $zn)?' ':' nicht';
				        echo "Zug ist für einen Turm ".$r." erlaubt";
							break;
			case "19":
			case "13":  $r=vertical_move($sv,$sn)||horizontal_move($zv, $zn) || diagonal_move($sv,$zv,$sn,$zn)?' ':' nicht';
				        echo "Zug ist für eine Dame ".$r." erlaubt";
							break;
            
            case "22":
            case "16": $r=horse_move($sv,$zv,$sn,$zn)?' ':' nicht';
				        echo "Zug ist für ein Springer ".$r." erlaubt";
							break;
                
			default: echo "Figur ".$figur." noch nicht bearbeitet";
        }
		echo"</div>";
		
		?>

</body>
</html>
