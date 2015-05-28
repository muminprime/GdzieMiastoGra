<?php
	// w ten sposób (ustawiaj¹c ujemny czas wygaœniêcia a resztê parametrów tak¹, jaka jest przy ciastku które chcemy usun¹æ) usuwamy dane ciastko
	$date_of_expiry = time() - 1 ;
	setcookie( "uzytkownik", $_COOKIE['uzytkownik'], $date_of_expiry );
?>