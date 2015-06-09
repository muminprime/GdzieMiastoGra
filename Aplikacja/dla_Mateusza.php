<?php


//
// Tutaj masz zapytanie do wyci¹gniêcia gatunków wybranych przez u¿ytkownika podczas logowania po jego loginie.
// A ni¿ej zapytanie do wyci¹gniêcia jego daty urodzenia
//

	mysql_connect("localhost","root","");

	$lgn = $_COOKIE['uzytkownik']; // tak wstawiæ login z ciasteczka; ¿eby przetestowaæ bez logowania, trzeba wstawiæ jakiœ istniej¹cy w bazie login rêcznie
	if ($zapytanie = mysql_query("SELECT u.login, du.ulubione_gatunki_id 
																FROM `database`.uzytkownicy as u, `database`.dane_uzytkownika as du 
																WHERE u.dane_uzytkownika_id=du.id 
																AND u.login='".$lgn."'")) // to zapytanie zwraca nam jeden rekord z kolumna "login" i "ulubione_gatunki_id"
	{
		$ind_do_tabeli_ulubione_gatunki = mysql_fetch_assoc($zapytanie)['ulubione_gatunki_id']; // zapisujemy sobie pod zmienn¹ id do tabeli ulubione_gatunki
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
														ON g.id=T2.id_gatunkow"); // to nie jest zbyt piêkne, ale dzia³a; w sumie nie musisz siê tym przejmowaæ, bo wszystko siê dzieje automatycznie
														//zapytanie to zwraca tabelkê z jedn¹ kolumn¹ "nazwa", gdzie w oddzielnych wierszach s¹ gatunki wybrane przez u¿ytkownika o wczeœniej wybranym loginie
		while ($data = mysql_fetch_assoc($gatunki))
		{
			echo $data['nazwa'].", "; // wypisuje ko kolei wszystkie gatunki, oczywiscie to jest tylko do pokazania, ¿e to zapytanie dzia³a
			// tak naprawdê, to ty musisz dzia³aæ ju¿ tylko na zmiennej $data, a reszt¹ siê nie przejmowaæ ;)
		}
	}
	
	
	// poni¿szy kod wyci¹ga Ci datê urodzenia po loginie
	$lgn = "Janeks";
	if ($zapytanie = mysql_query("SELECT u.login, du.data_urodzenia FROM `database`.uzytkownicy u, `database`.dane_uzytkownika du WHERE u.dane_uzytkownika_id=du.id AND u.login='".$lgn."'"))
		echo mysql_fetch_assoc($zapytanie)['data_urodzenia'];
	else
		echo "b³¹d w zapytaniu";

?>