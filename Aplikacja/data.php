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
	
	
	$gatunki_zespolow = mysql_query("	SELECT 	zespoly.id as 'id',
																						zespoly.nazwa as 'zespol', 
																						gatunki.nazwa as 'gatunek'
																		FROM database.zespoly, database.gatunki
																		WHERE zespoly.gatunki_id1 = gatunki.id 
																		OR zespoly.gatunki_id2 = gatunki.id 
																		OR zespoly.gatunki_id3 = gatunki.id
																		ORDER BY zespol");
													
	$gatunki_num_rows = mysql_num_rows($gatunki_zespolow);
	
	
	/*
		PONIŻSZY BLOK JEST DOŚĆ SKOMPLIKOWANY, ALE DZIAŁA!
		Chodzi o to, że z tabeli 'zespoly' pobieramy sobie dane dotyczące gatunków, które w tej tabeli są reprezentowane przez numery id z tabeli 'gatunki'. 
		Te dane zlepiamy w jednego stringa i ładujemy do specjalnego rekordu w tabeli 'zespoly'. Dzięki temu możemy prostym zapytaniem SQL wyświetlić wszystkie gatunki (praktycznie tak, jak to robiliśmy poprzednio).
		Taki sposób wydawał mi się mimo wszystko najprostszy.
		Trzeba mieć świadomość, że poniższy blok powinien być wykonywany za każdym razem, gdy ktoś dokona zmian w gatunkach danego zespołu, albo przy każdym wyświetlaniu wyników/filtrowaniu*
				*czy na pewno przy filtrowaniu będę w stanie stwierdzić jak już naprawię filtrowanie
	*/
	$all_gatunki = "";
	$zespol_poprzedni = mysql_fetch_assoc(mysql_query("SELECT zespoly.nazwa as 'zespol' FROM database.zespoly ORDER BY zespol"))['zespol']; // przypisujemy pierwszy zespol pod ta zmienna (order by musi byc takie samo, jak w zapytaniu $gatunki_zespolow)
	while($data=mysql_fetch_assoc($gatunki_zespolow))
	{
		if ((($zespol = $data['zespol']) == $zespol_poprzedni) AND ($data['gatunek'] != "")) // jeśli ciągle rozpatrujemy ten sam zespół i jednocześnie rozpatrywane pole gatunku nie jest puste
		{
			$all_gatunki .= $data['gatunek'].", ";
			$id = $data['id']; // potrzebne w elsie, zeby wzielo poprzednia wartosc id, a nie juz nastepna (bo wejscie do else'a nastepuje, gdy juz sprawdzilismy wszystkie gatunki danego zespolu i przeskoczylismy na pierwszy rekord nastepnego zespolu)
		}
		else
		{
			wpisz_gatunki_do_bazy($all_gatunki, $id);
			$all_gatunki = ""; // wyzeruj zmienną
			if ($data['gatunek'] != "") // wykonujemy raz to, co w ifie, pod warunkiem ze nie jest to puste pole
				$all_gatunki .= $data['gatunek'].", ";
			$zespol = $data['zespol']; // niezależnie od powyższego przypisujemy obecny zespół pod zmienną
		}	
		$zespol_poprzedni = $zespol;
	}
	// ponizej musimy dac te funkcje, bo powyzszy while jest tak skonstruowany, ze dla ostatniego wiersza $gatunki_zespolow nigdy nie wejdzie w else, czyli nigdy nie wykona wpisz_gatunki_do_bazy...tak wiec trzeba to zapewnic po wyjsciu z petli
	wpisz_gatunki_do_bazy($all_gatunki, $id);
	
	function wpisz_gatunki_do_bazy($gat, $id)
	{
		$gat = trim($gat); // obcinamy stringa z ewentualnych spacji dookoła
		$gat = trim($gat, ","); // obcinamy z przecinków
		$zapytanie = "UPDATE database.zespoly SET gatunki='".$gat."' WHERE id='".$id."'"; //wpisujemy all_gatunki do odpowiedniej tabeli
		mysql_query($zapytanie);
	}
	
	
	$wynik = mysql_query("SELECT 	koncerty.id as 'id koncertu', 
																koncerty.data_godzina as 'data_godzina', 
																zespoly.nazwa as 'nazwa_zespolu', 
																lokale.nazwa as 'nazwa_lokalu',
																zespoly.gatunki as 'gatunek',
																lokale.adres as 'adres_lokalu',
																koncerty.cena,
																koncerty.wiek
												FROM database.koncerty, database.zespoly, database.lokale 
												WHERE koncerty.zespoly_id=zespoly.id 
												AND koncerty.lokale_id=lokale.id");
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