<?php
	mysql_connect("localhost","root","");
	#$name = mysql_real_escape_string($_POST['name']);
	#$szerokosc = $_POST['name'];
	
	
	/*
	//ponizszy blok trzeba skopiowac dla wszystkich mozliwosci filtrowania (kluby, zespoly, daty itp)
	$gatunki = mysql_query("SELECT 	gatunki.id as 'id', gatunki.nazwa as 'nazwa_gatunku'
																		FROM		database.gatunki");
	$gatunki_num_rows = mysql_num_rows($gatunki);
	if($gatunki_num_rows==0)
		echo "Nie ma zadnych gatunkow";
	else
	{ // w ponizszej tabeli bedziemy przechowywac nazwy gatunkow i wartosc true/false
		$gatunki_ar = array(); //stworz tablice na gatunki
		while($data=mysql_fetch_assoc($gatunki))
			$gatunki_ar[] = array($data['nazwa_gatunku'],false); // dodaj do tablicy mala tablice, ktora bedzie przechowywac nazwe gatunku i wartosc true/false (domyslnie false, true gdy uzytkownik wybierze ten gatunek podczas filtrowania wynikow)
	}
	//tak wyznaczamy dlugosc tablicy i odwolujemy sie do jej elementow
	echo "Gatunkow jest ".count($gatunki_ar).", a trzeci z nich to: ".$gatunki_ar[2][0]; // pierwszy indeks to kolejny numer gatunku, drugi indeks to nazwa gatunku: [0], albo wartosc true/false: [1]
	echo " .Gatunek ten ma przypisana wartosc: ".$gatunki_ar[2][1];
	// na podstawie $gatunki_ar mozna automatycznie zrobic liste checkboxow
	// filtr trzeba zrobic tak, zeby zaznaczenie danej opcji po prostu zmienialo wartosc true/false danej pozycji
	// pozniej zrobie funkcje, ktora posprawdza gdzie jest true i na tej podstawie bede generowac zapytanie sql
	
	*/
	
	
	
	$wynik = mysql_query("SELECT 	koncerty.id as 'id koncertu', 
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
												AND zespoly.gatunki_id=gatunki.id");
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