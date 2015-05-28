<?php
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	
	mysql_connect("localhost","root","");
	
	//UWAGA! ponizsze zapytanie jest prymitywne. Gdy chcialem jeszcze polaczyc to z nazwa zespolu, to sie robil problem z laczeniem tabel. pewnie cos jest nie tak z relacjami
	$zapytanie = "SELECT 	uzytkownicy.login as 'login', 
												uzytkownicy.haslo as 'haslo'
								FROM database.uzytkownicy";
	
	$wynik = mysql_query($zapytanie);
	
	$flaga = false;
	while ($data=mysql_fetch_assoc($wynik))
	{
		if ($data['login'] == $login)
		{
			$flaga = true;
			if ($data['haslo'] == $haslo)
			{
				$date_of_expiry = time() + 30 ;
				setcookie( "uzytkownik", $login, $date_of_expiry );
				echo "Zalogowano!";
				break;
			}
			else
			{
				echo "Niepoprawne has³o";
			}
		}
	}
	if (!$flaga)
	{
		echo "Podany login nie istnieje";
	}
	
?>