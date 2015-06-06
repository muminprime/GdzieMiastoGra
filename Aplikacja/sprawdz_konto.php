<?php
mysql_connect("localhost","root","");
$zapytanie = "SELECT u.login, u.email
							FROM `database`.uzytkownicy as u";
if (mysql_query($zapytanie)) // jesli zapytanie sie powiedzie
{
	if (mysql_num_rows(mysql_query($zapytanie." WHERE u.login="."\"".$_POST['username']."\"")) == 0) // jesli nie ma takiego loginu
	{
		if (mysql_num_rows(mysql_query($zapytanie." WHERE u.email="."\"".$_POST['useremail']."\"")) == 0) // jesli nie ma takiego emaila
		{
			echo "ok"; // ten string jest wykorzystywany w funkcji zwrotnej w pliku rejestracja.php
		}
		else
			echo "Podany email jest ju¿ przypisany do któregoœ konta";
	}
	else
		echo "Podany login jest ju¿ zajêty";
}	
else
	echo "B³¹d w zapytaniu";
?>