<?php
	mysql_connect("localhost","root","");
	#$name = mysql_real_escape_string($_POST['name']);
	#$szerokosc = $_POST['name'];
	
	$wynik = mysql_query("SELECT * FROM database.koncerty ");
	$wynik_num_rows = mysql_num_rows($wynik);
		
	if($wynik_num_rows==0)
		echo "Nie ma zadnych koncertow";
	else
	{
		while($data=mysql_fetch_assoc($wynik)){
		echo "<div id=\"koncert\">
		<div id=\"koncert_logo\">
		<img src=\"image/inne/logo.png\" style=\"width:80%; height:95%; border: 2px solid red;margin-top:10%;margin-left:10%;\">
		</div>
		<div id=\"koncert_nazwa\">
		<img src=\"image/inne/glosnosc_lewa.png\" style=\"margin-left:20%;width:10%; height:65%;\">
		".$data['nazwa_zespolu']."
		<img src=\"image/inne/glosnosc_prawa.png\" style=\"width:10%; height:65%;\">
		</div>
		<div id=\"koncert_lewe_dane\">
		<img src=\"image/inne/nuta_osemka.png\" style=\"width:10%; height:15%;\">
		Gatunek: ".$data['gatunek'].
		"</br>
		<img src=\"image/inne/nuta_osemka.png\" style=\"width:10%; height:15%;\">
		Klub: ".$data['nazwa_lokalu'].
		"</br>
		<img src=\"image/inne/nuta_osemka.png\" style=\"width:10%; height:15%;\">
		Adres: ".$data['adres_lokalu']."
		</div>
		<div id=\"koncert_prawe_dane\">
		<img src=\"image/inne/nuta_osemka.png\" style=\"width:10%; height:15%;\">
		Data: ".$data['data_godzina'].
		"</br>
		<img src=\"image/inne/nuta_osemka.png\" style=\"width:10%; height:15%;\">
		Wstęp: ".$data['cena'].
		"</br>
		<img src=\"image/inne/nuta_osemka.png\" style=\"width:10%; height:15%;\">
		Ograniczenia: ".$data['wiek'].
		"
		</div>	
		</div>";	
		}
			
	}
	
?>