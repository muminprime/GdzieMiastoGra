<?php


//
// Tutaj masz zapytanie do wyci�gni�cia gatunk�w wybranych przez u�ytkownika podczas logowania po jego loginie.
// A ni�ej zapytanie do wyci�gni�cia jego daty urodzenia
//

	mysql_connect("localhost","root","");

	$lgn = $_COOKIE['uzytkownik']; // tak wstawi� login z ciasteczka; �eby przetestowa� bez logowania, trzeba wstawi� jaki� istniej�cy w bazie login r�cznie
	if ($zapytanie = mysql_query("SELECT u.login, du.ulubione_gatunki_id 
																FROM `database`.uzytkownicy as u, `database`.dane_uzytkownika as du 
																WHERE u.dane_uzytkownika_id=du.id 
																AND u.login='".$lgn."'")) // to zapytanie zwraca nam jeden rekord z kolumna "login" i "ulubione_gatunki_id"
	{
		$ind_do_tabeli_ulubione_gatunki = mysql_fetch_assoc($zapytanie)['ulubione_gatunki_id']; // zapisujemy sobie pod zmienn� id do tabeli ulubione_gatunki
		$gatunki = mysql_query("SELECT g.nazwa FROM `database`.gatunki as g RIGHT JOIN
															(SELECT gat1 as 'id_gatunkow' FROM 
																(SELECT gat1 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat2 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat3 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat4 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat5 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat6 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat7 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat8 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat9 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat10 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																UNION ALL
																SELECT gat11 FROM `database`.ulubione_gatunki WHERE id = ".$ind_do_tabeli_ulubione_gatunki."
																) as T1
															WHERE gat1 > 0) as T2
														ON g.id=T2.id_gatunkow"); // to nie jest zbyt pi�kne, ale dzia�a; w sumie nie musisz si� tym przejmowa�, bo wszystko si� dzieje automatycznie
														//zapytanie to zwraca tabelk� z jedn� kolumn� "nazwa", gdzie w oddzielnych wierszach s� gatunki wybrane przez u�ytkownika o wcze�niej wybranym loginie
		while ($data = mysql_fetch_assoc($gatunki))
		{
			echo $data['nazwa'].", "; // wypisuje ko kolei wszystkie gatunki, oczywiscie to jest tylko do pokazania, �e to zapytanie dzia�a
			// tak naprawd�, to ty musisz dzia�a� ju� tylko na zmiennej $data, a reszt� si� nie przejmowa� ;)
		}
	}
	
	
	// poni�szy kod wyci�ga Ci dat� urodzenia po loginie
	$lgn = "Janeks";
	if ($zapytanie = mysql_query("SELECT u.login, du.data_urodzenia FROM `database`.uzytkownicy u, `database`.dane_uzytkownika du WHERE u.dane_uzytkownika_id=du.id AND u.login='".$lgn."'"))
		echo mysql_fetch_assoc($zapytanie)['data_urodzenia'];
	else
		echo "b��d w zapytaniu";

?>