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
	
	
	// BLOK WYKONAWCZY DLA DAT
	// obecnie formatka na stronie nie pozwala wpisywac zlego miesiaca ani dnia tygodnia powyżej 31, 
	// ALE! jak np dla lutego wpiszemy 31, to zaakceptuje, tyle ze zwroci pusta wartosc. Gorzej z rokiem, bo jak wpiszemy np 0001, to zaakceptuje to jako rok 0001
	// jeszcze gorzej, że nie da się rozróżnić, czy nie wpisano nic, czy np jest blednie wpisany dzień (np. 31 lutego, jak w przykładzie powyżej), ale powiedzmy, że nam to wystarczy
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
	$fd = DateTime::createFromFormat('Y-m-d', $from_date);
	$td = DateTime::createFromFormat('Y-m-d', $to_date); // obiekty, dzięki którym sprawdzimy poprawność daty
	
	// TUTAJ TRZEBA PRZEMYŚLEĆ, JAK OGRANICZAĆ WYNIKI WZGLĘDEM BIEŻĄCEJ DATY
	
	//$cur_date = new DateTime();
	//$cur_date->modify('-14 days');
	
	//echo $cur_date->format('Y-m-d');
	//echo $from_date;
	//echo "|".$to_date."|";
	//if ( $ob != false)
	//	echo $ob->format('Y-m-d');
	$from_date .= " 00:00:00" ; //doklejamy godzine, żeby był format DATETIME
	$to_date .= " 00:00:00" ; // można by też w drugą stronę, czyli w zapytaniu sql konwertować pole DATETIME z bazy na samą datę funkcją DATE() i dopiero wtedy porównywać z naszymi datami, ale byłoby to wolniejsze, szczególnie przy wielu rekordach

	
	// COŚ NIE DO KOŃCA DZIAŁA, JEŚLI CHODZI O DOKŁADNE PORÓWNYWANIE DATY Z GODZINĄ; poniżej konwertujemy datetime na date, ale mimo to, coś jest nie tak - trzeba to przemysleć
	if (($fd !== false) AND ($td == false)) // jesli pierwsza data ma poprawny format (a druga albo jest pusta, albo mamy kiks z lutym opisany powyżej)
		$zapytanie .= " AND DATE(koncerty.data_godzina) > DATE('".$from_date."')"; // wyświetl koncerty późniejsze
	else if (($fd == false) AND ($td !== false)) // jw, tylko dla drugiej daty
		$zapytanie .= " AND DATE(koncerty.data_godzina) < DATE('".$to_date."')"; // wyświetl koncerty wcześniejsze
	else if (($fd !== false) AND ($td !== false)) // jeśli obydwie daty mają poprawny format (albo nie są puste, albo mamy kiks z lutym, opisany powyżej)
	{
		if ($from_date == $to_date)
			$zapytanie .= " AND DATE(koncerty.data_godzina) = DATE('".$from_date."')";
		else	
			$zapytanie .= " AND DATE(koncerty.data_godzina) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')";
		}
	else 
		{}
	
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