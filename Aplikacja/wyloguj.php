<?php
	// w ten spos�b (ustawiaj�c ujemny czas wyga�ni�cia a reszt� parametr�w tak�, jaka jest przy ciastku kt�re chcemy usun��) usuwamy dane ciastko
	$date_of_expiry = time() - 1 ;
	setcookie( "uzytkownik", $_COOKIE['uzytkownik'], $date_of_expiry );
?>