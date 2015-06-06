<?php

$strona_poczatkowa = 'http://localhost';
$strona_rejestracji = 'http://localhost/rejestracja.php';

//wstawiamy dane o nowym użytkowniku do bazy, czyli de facto tworzymy konto
if (mysql_connect("localhost","root","")) // jesli połączenie się powiedzie, to...
{
	if (mysql_query("	INSERT INTO `database`.uzytkownicy (login, haslo, email)
																						VALUES ('".$_POST['username']."', '".$_POST['password']."', '".$_POST['useremail']."')")) // jeśli zapytanie jest poprawne i/lub zapytanie się powiedzie, to...
	{ // daj komunikat i przekieruj to $strona_poczatkowa
		echo "<script type=\"text/javascript\"> 
		alert(\"Konto utworzono pomyślnie! Możesz się teraz zalogować.\"); 
		window.location.href='".$strona_poczatkowa."';
		</script>";
		exit; // bo ktoś tak radził
	}
	else
	{ // czyli zapytanie jest błędne bądź się nie powiodło
		echo "<script type=\"text/javascript\"> 
		alert(\"Błąd we wstawianiu danych do bazy. Konta nie utworzono.\"); 
		window.location.href='".$strona_rejestracji."';
		</script>";
		exit; // bo ktoś tak radził
	}
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

