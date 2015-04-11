<?php
	mysql_connect("localhost","root","");
	#$name = mysql_real_escape_string($_POST['name']);
	
	
	$wynik = mysql_query("SELECT * FROM database.koncerty ");
	$wynik_num_rows = mysql_num_rows($wynik);
		
	if($wynik_num_rows==0)
		echo "Nie ma zadnych koncertow";
	else
	{
		while($data=mysql_fetch_assoc($wynik)){
		echo "<div id=\"koncert\">
		<div id=\"koncert_logo\">
		Logo
		</div>
		<div id=\"koncert_nazwa\">
		<b>
		".$data['nazwa_zespolu']."
		</b>
		</div>
		<div id=\"koncert_lewe_dane\">
		<b>
		Gatunek muzyki: ".$data['gatunek'].
		"</br>Gdzie grają: ".$data['nazwa_lokalu'].
		"</br>Adres: ".$data['adres_lokalu']."
		</b>
		</div>
		<div id=\"koncert_prawe_dane\">
		<b>
		Data i godzina: ".$data['data_godzina'].
		"</br>Cena biletu: ".$data['cena'].
		"</br>Ograniczenia wiekowe: ".$data['wiek'].
		"</b>
		</div>	
		</div>";	
		}
			
	}
	
?>