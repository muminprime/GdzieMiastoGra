<?php

$strona_poczatkowa = 'http://localhost';
$strona_rejestracji = 'http://localhost/rejestracja.php';

//wstawiamy dane o nowym użytkowniku do bazy, czyli de facto tworzymy konto
if (mysql_connect("localhost","root","")) // jesli połączenie się powiedzie, to...
{
	
	if (mysql_query("	INSERT INTO `database`.uzytkownicy (login, haslo, email)
																						VALUES ('".$_POST['username']."', '".$_POST['password']."', '".$_POST['useremail']."')")) // jeśli zapytanie jest poprawne i/lub zapytanie się powiedzie, to...
	{ 
		// w sumie tutaj powinna byc cala reszta kodu, bo jak to sie nie uda, to nie ma sensu robic reszty, no ale juz mniejsz z tym
	}
	
	/* to by trzeba bylo powtorzyc dla kazdego zapytania, wiec bez sensu...
	else
	{ // czyli zapytanie jest błędne bądź się nie powiodło
		echo "<script type=\"text/javascript\"> 
		alert(\"Błąd we wstawianiu danych do bazy. Konta nie utworzono.\"); 
		window.location.href='".$strona_rejestracji."';
		</script>";
		exit; // bo ktoś tak radził
	}*/
	
	// poniżej dodawanie gatunków do bazy
	$gatunki = mysql_query("SELECT g.nazwa as 'nazwa_gatunku' FROM database.gatunki as g");
	while ($data=mysql_fetch_assoc($gatunki))
		$gat_arr[] = $data['nazwa_gatunku'];
	$flag = false;
	foreach ($_POST as $key => $value) // sprawdzamy kazdy element przesłany w formularzu
	{
		$key = str_replace("_", " ", $key); // musimy zamienić "_" na spacje, bo php przy przesylaniu danych z formularza z poprzedniej strony zamienia sobie spacje na "_" ;] wiec my musimy przywrocic oryginalny format, jesli chcemy to porownywac z danymi w bazie
		foreach ($gat_arr as $gat) // dla każdego elementu formularza sprawdzamy każdą nazwę gatunku z bazy danych
		{
			if ($key == $gat)
			{ // jeśli w formularzu przesłano pole o nazwie, która odpowiada jakiemuś gatunkowi, to zapisz nazwę gatunku do tablicy $gat_uzytkownika
				$flag = true; // może być sytuacja, że użytkownik nie wybrał żadnego gatunku, więc trzeba się zabezpieczyć tą flagą, żeby później nie odwołać się przypadkiem do tablicy $gat_uzytkownika, która tak naprawdę nie powstała
				$gat_uzytkownika[] = $key;
			}
		}
	}
	/*
	// poniższa pętla zajmuje się uzupełnieniem tabeli ulubione_gatunki o dodatkową kolumnę, jeśli obecny użytkownik zaznaczy więcej gatunków niż ta tabela ma przewidzianych na to kolumn
	// w sumie powinno to być w innym miejscu no ale już...
	foreach ($gat_arr as $key => $value) // tutaj $key to indeks
	{
	//	echo $key." ;";
	// musimy wywołać procedurę składowaną dodaj_kolumne. dlaczego? bo wklejenie bezpośrednio kodu tej procedury tutaj nie działało...dlaczego? bo nie ;p 
	// generalnie sama ta procedura jest dość zawiła, ale taka ma być i działa - jest ona efektem wielu godzin spędzonych z wujkiem google...
	// ogólnie procedura ta sprawdza, czy istnieje dana kolumna danej tabeli, a jeśli nie, to ją tworzy i ustawia defaultową wartość na 0
	// w sumie umieszczanie jej w tym miejscu w taki sposób jest średnim rozwiązaniem, bo przy każdym tworzeniu konta procedura ta wywoływać się będie tyle razy, ile jest gatunków w bazie
	// a wystarczyłoby odpalać ją tylko wtedy, kiedy dodajemy nowe pole do tabeli gatunki (żeby wszystko było jak trzeba, powinna też być procedura usuwająca kolumnę jeśli byśmy kasowali jakiś gatunek no ale bez przesady...)
		mysql_query("CALL database.dodaj_kolumne('ulubione_gatunki', 'gat".($key+1)."')");
	}
	*/
	
	// dodajemy date urodzenia do danych uzytkownika
	mysql_query("INSERT INTO `database`.dane_uzytkownika (data_urodzenia) VALUES('".$_POST['bday']."')");
	$dane_uzytkownika_ind = mysql_insert_id(); // zapisujemy id ostatnio wygenerowanego rekordu, czyli tego z powyzszej komendy INSERT
	
	if ($flag) // jeśli użytkownik wybrał jakiś gatunek, czyli powstala zmienna $gat_uzytkownika
	{
		//za pierwszym gatunkiem musimy wykonac 2 ponizsze linijki, czyli najpierw stworzyc rekord
		$gat_ind = mysql_fetch_assoc(mysql_query("SELECT g.id as 'id' FROM database.gatunki as g WHERE g.nazwa = '".$gat_uzytkownika[0]."'"))['id']; // indeks gatunku
		mysql_query("INSERT INTO database.ulubione_gatunki (gat1) VALUES (".$gat_ind.")");
		$ulub_gat_ind = mysql_insert_id(); // zapisujemy id ostatnio wygenerowanego rekordu, czyli tego z powyzszej komendy INSERT
		
		if (count($gat_uzytkownika) > 1)
		{
			foreach ($gat_uzytkownika as $key => $value) // key jest tutaj indeksem
			{
				if ($key < count($gat_uzytkownika)-1) // poniewaz to jest foreach, a pierwszy element juz jest wstawiony
				{
					$query = mysql_query("SELECT g.id as 'id' FROM database.gatunki as g WHERE g.nazwa = '".$gat_uzytkownika[($key+1)]."'"); // wybieramy rekord z gatunkiem odpowiadajacym kolejnemu gatunkowi z wyboru uzytkownika
					$gat_ind = mysql_fetch_assoc($query)['id']; // uzyskujemy indeks gatunku
					mysql_query("UPDATE `database`.ulubione_gatunki SET gat".($key+2)."=".$gat_ind." WHERE `id`=".$ulub_gat_ind); // key+2 wyniki z nazewnictwa kolumn, ktore zaczalem od 1
				}
			}
		}
		// dodajemy powiazanie do ulubionych gatunkow
		mysql_query("UPDATE `database`.dane_uzytkownika SET ulubione_gatunki_id=".$ulub_gat_ind." WHERE `id`=".$dane_uzytkownika_ind); 
	}
	// dodajemy powiazanie do danych uzytkownika
	mysql_query("UPDATE `database`.uzytkownicy SET dane_uzytkownika_id=".$dane_uzytkownika_ind." WHERE `login`='".$_POST['username']."'");
	
	echo "Przekierowywanie..."; // żeby nie wisiała pusta strona
	
		//daj komunikat o powodzeniu i przekieruj do $strona_poczatkowa (wypadaloby cala gore opatrzyc w jakies wylapywanie bledow no ale juz tam...)
		echo "<script type=\"text/javascript\"> 
		alert(\"Konto utworzono pomyślnie! Możesz się teraz zalogować.\"); 
		window.location.href='".$strona_poczatkowa."';
		</script>";
		exit; // bo ktoś tak radził
}
else
{ // czyli nie udało się połączyć z bazą
	echo "<script type=\"text/javascript\"> 
		alert(\"Błąd połączenia z bazą danych. Konta nie utworzono.\"); 
		window.location.href='".$strona_rejestracji."';
		</script>";
		exit; // bo ktoś tak radził
}
?>

