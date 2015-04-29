<?php
	mysql_connect("localhost","root","");
	
	$zapytanie = "SELECT 	koncerty.id as 'id koncertu', 
																koncerty.data_godzina as 'data_godzina', 
																zespoly.nazwa as 'nazwa_zespolu', 
																lokale.nazwa as 'nazwa_lokalu',
																gatunki.nazwa as 'gatunek',
																lokale.adres as 'adres_lokalu',
																koncerty.cena,
																koncerty.wiek
												FROM database.koncerty, database.zespoly, database.lokale, database.gatunki 
												WHERE koncerty.zespoly_id=zespoly.id 
												AND koncerty.lokale_id=lokale.id 
												AND zespoly.gatunki_id=gatunki.id";
	
	
	
	// BLOK WYKONAWCZY DLA GATUNKOW
	$gatunki_array_przek = $_POST['array1']; // zapisujemy sobie pod ta zmienna tablice przekazana z pliku index.php
	//$nazwa = $gatunki_array_przek[0][0]; // tutaj zamiast nazwy gatunku z [n][0] pozycji tablicy zwraca nam tylko pierwsza litere nazwy...
	// generalnie nie da sie tak po prostu przekazac tablicy wielowymiarowej do php...
	$gatunki_array_php = array();
	foreach ($gatunki_array_przek as $x) { //poniewaz php sobie skleil tablice dwuwymiarowa w taki sposob, ze jest to teraz tablica jednowymiarowa i pod kazdym indeksem jest "nazwa_gatunku,liczba"
	// czyli jak my sie spodziewamy np w gatunki_array_przek[0][0] miec "Blues" a w gatunki_array_przek[0][1] miec "0", to tak nie bedzie, ale za to w gatunki_array_przek[0] bedzie "Blues,0"
		$gatunki_array_php [] = explode(",", $x); // stad ta petla...ale trzeba to zmienic, bo co jesli w nazwie gatunku/zespolu beda przecinki????
	}
	$licznik = 0;
	foreach ($gatunki_array_php as $g) { // dla wszystkich agtunkow
		if ($g[1] == "1"){ // jesli dany gatunek zostal wybrany
			$licznik += 1; 
			if ($licznik==1)  // jesli to pierwszy wybor, to:
					$zapytanie .= " AND (gatunki.nazwa=\"".$g[0]."\"";
			else if ($licznik > 1) // jesli to kolejny wybor, to:
					$zapytanie .= " OR gatunki.nazwa=\"".$g[0]."\"";
		}
	}
	if ($licznik > 0) // jesli byl jakis wybor, to niezaleznie od ilosci wyborow, zakoncz zapytanie nawiasem
		$zapytanie .= ")";
	
	
	// BLOK WYKONAWCZY DLA ZESPOLOW
	$zespoly_array_przek = $_POST['array2']; // analogicznie jak poprzednio, to trzeba bedzie zmienic
	$zespoly_array_php = array();
	foreach ($zespoly_array_przek as $x) {
		$zespoly_array_php [] = explode(",", $x); 
	}
	$licznik = 0;
	foreach ($zespoly_array_php as $g) { 
		if ($g[1] == "1"){ 
			$licznik += 1; 
			if ($licznik==1)  
					$zapytanie .= " AND (zespoly.nazwa=\"".$g[0]."\"";
			else if ($licznik > 1) 
					$zapytanie .= " OR zespoly.nazwa=\"".$g[0]."\"";
		}
	}
	if ($licznik > 0) // jesli byl jakis wybor, to niezaleznie od ilosci wyborow, zakoncz zapytanie nawiasem
		$zapytanie .= ")";
	
	
	
	// BLOK WYKONAWCZY DLA LOKALI
	$lokale_array_przek = $_POST['array3']; // analogicznie jak poprzednio, to trzeba bedzie zmienic
	$lokale_array_php = array();
	foreach ($lokale_array_przek as $x) {
		$lokale_array_php [] = explode(",", $x); 
	}
	$licznik = 0;
	foreach ($lokale_array_php as $g) { 
		if ($g[1] == "1"){ 
			$licznik += 1; 
			if ($licznik==1)  
					$zapytanie .= " AND (lokale.nazwa=\"".$g[0]."\"";
			else if ($licznik > 1) 
					$zapytanie .= " OR lokale.nazwa=\"".$g[0]."\"";
		}
	}
	if ($licznik > 0) // jesli byl jakis wybor, to niezaleznie od ilosci wyborow, zakoncz zapytanie nawiasem
		$zapytanie .= ")";
	
	
	
	
	
	$wynik = mysql_query($zapytanie);
	$wynik_num_rows = mysql_num_rows($wynik);
	
	
	//ponizszy kod przkopiowany z data.php
	if($wynik_num_rows==0)
		echo "Nie ma takich koncertow";
	else
	{
		while($data=mysql_fetch_assoc($wynik)){
		echo "<div id=\"koncert\">
		<div id=\"koncert_logo\">
		<img src=\"image/inne/logo.png\" style=\"width:80%; height:95%; border: 2px solid red;margin-top:10%;margin-left:10%;\">
		</div>
		<div id=\"koncert_nazwa\">
		<center>
		<img src=\"image/inne/glosnosc_lewa.png\" style=\"width:10%; height:65%;\">
		".$data['nazwa_zespolu']."
		<img src=\"image/inne/glosnosc_prawa.png\" style=\"width:10%; height:65%;\">
		</center>
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