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
		<p style=\"margin-top:40%;margin-left:40%\" >Logo</p>
		</div>
		<div id=\"koncert_nazwa\">
		<b>
		<p style=\"margin-left:45%;margin-top:0.5%;\">".$data['nazwa_zespolu']."</p>
		</b>
		</div>
		<div id=\"koncert_lewe_dane\">
		<b>
		<p style=\"margin-top:3%;margin-left:3%\">Gatunek muzyki: ".$data['gatunek']."</p>
		<p style=\"margin-top:3%;margin-left:3%\">Gdzie grają: ".$data['nazwa_lokalu']."</p>
		<p style=\"margin-top:3%;margin-left:3%\">Adres: ".$data['adres_lokalu']."</p>
		</b>
		</div>
		<div id=\"koncert_prawe_dane\">
		<b>
		<p style=\"margin-top:3%;margin-left:3%\">Data i godzina: ".$data['data_godzina']."</p>
		<p style=\"margin-top:3%;margin-left:3%\">Cena biletu: ".$data['cena']."</p>
		<p style=\"margin-top:3%;margin-left:3%\">Ograniczenia wiekowe: ".$data['wiek']."</p>
		</b>
		</div>	
		</div>";	
		}
			
	}
	
?>