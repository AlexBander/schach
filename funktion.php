<?php
function brettzeichnen($brett){
	echo"<table>";
	foreach ($brett as $zeile){
		echo"<tr>";
		foreach($zeile as $spalte){
			echo"<td>".$spalte."</td>";
		}
		echo"</tr>";
	}
	echo"</table>";
}
function liesDatei(){
	if(file_exists('spielstatus.txt')){
		$schachbrett = fopen('spielstatus.txt',"r");
		$result = fread($schachbrett,((integer)(filesize('spielstatus.txt'))));
		$zuege =  substr($result,strpos($result,',')+1);
		return strstr(($result),',',true);
	}else{
		echo "keine Datei gefunden.";
	}
}
?>
