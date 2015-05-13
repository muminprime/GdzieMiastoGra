<?php
	mysql_connect("localhost","root","");
	
	$zapytanie = "SELECT 	koncerty.id as 'id koncertu', 
																koncerty.data_godzina as 'data_godzina', 
																zespoly.nazwa as 'nazwa_zespolu', 
																lokale.nazwa as 'nazwa_lokalu',
																zespoly.gatunki as 'gatunek',
																lokale.adres as 'adres_lokalu',
																koncerty.cena,
																koncerty.wiek
												FROM database.koncerty, database.zespoly, database.lokale
												WHERE koncerty.zespoly_id=zespoly.id 
												AND koncerty.lokale_id=lokale.id";
	
	
	
	// BLOK WYKONAWCZY DLA GATUNKOW

	$gatunki_array = $_POST['gatunki_array']; // zapisujemy sobie pod ta zmienna tablice przekazana z pliku index.php
	$licznik = 0;
	foreach ($gatunki_array as $g) { // dla wszystkich agtunkow
		if ($g[1] == "1"){ // jesli dany gatunek zostal wybrany
			$licznik += 1; 
			if ($licznik==1)  // jesli to pierwszy wybor, to:
					$zapytanie .= " AND (zespoly.gatunki LIKE \"%".$g[0]."%\""; // UWAGA, TO JEST NIE DO KONCA DOBRE!! Użycie LIKE w takiej formie prowadzi do tego, że np. jak mamy 2 gatunki: Pop i PopRock, to LIKE "%Pop%" będzie pasować również do PopRock! Żeby to było ładnie, trzeba po prostu porównywać każdy gatunek z trzech możliwych dla zespołu...ale do tego trzeba zmodyfikować główne zapytanie, to tutaj bardziej skomplikować a i najprawdopodobniej w ogóle zmienić kształt gatunki_array...
			else if ($licznik > 1) // jesli to kolejny wybor, to:
					$zapytanie .= " OR zespoly.gatunki LIKE \"%".$g[0]."%\"";
		}
	}
	if ($licznik > 0) // jesli byl jakis wybor, to niezaleznie od ilosci wyborow, zakoncz zapytanie nawiasem
		$zapytanie .= ")";
	
	
	// BLOK WYKONAWCZY DLA ZESPOLOW
	$zespoly_array = $_POST['zespoly_array']; // przechwytujemy całą 2-wymiarową tablicę z index.php
	$licznik = 0;
	foreach ($zespoly_array as $z) { 
		if ($z[1] == "1"){ // jeśli dany zespół został zaznaczony...
			$licznik += 1; 
			if ($licznik==1)  
				$zapytanie .= " AND (zespoly.nazwa=\"".$z[0]."\"";
			else if ($licznik > 1) 
				$zapytanie .= " OR zespoly.nazwa=\"".$z[0]."\"";
		}
	}
	if ($licznik > 0) // jeśli był jakiś wybór, to niezależnie od ilości wyborów, zakończ zapytanie nawiasem
		$zapytanie .= ")";
	
	
	// BLOK WYKONAWCZY DLA LOKALI
	$lokale_array = $_POST['lokale_array']; // analogicznie jak dla zespołów
	$licznik = 0;
	foreach ($lokale_array as $l) { 
		if ($l[1] == "1"){ 
			$licznik += 1; 
			if ($licznik==1)  
					$zapytanie .= " AND (lokale.nazwa=\"".$l[0]."\"";
			else if ($licznik > 1) 
					$zapytanie .= " OR lokale.nazwa=\"".$l[0]."\"";
		}
	}
	if ($licznik > 0) 
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