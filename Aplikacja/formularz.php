<?php
$wybor = $_POST['wybor']; 
if($wybor==1)
{
	echo "Wybrano formularz dla uzytkownika";
}
else if($wybor==2)
{
	echo "
	<form>
	<label id=\"div_poje_wpisu\">Login*:</label><input required title=\"Login może miec maksymalnie 20 znakow. Musi zaczynać się od malej litery, dużej litery lub cyfry. Może zawierac symbole: _ - \" pattern=\"^([a-zA-Z0-9]{1})([a-zA-Z0-9_-]{2,20})$\" placeholder=\"Podaj login\" type=\"text\" id=\"pole\" name=\"username\" size=\"15\" maxlength=\"20\"><br>
	<label id=\"div_poje_wpisu\">Hasło*:</label><input required pattern=\"^(?=.*\d)(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\_\+\-\=])(?=.*[A-Z])(?!.*\s).{8,}$\" title=\"Wpisane hasło użytkownika musi mieć minimum osiem znaków, pośród których musi być co najmniej jedna wielka litera, jedna mała, jedna cyfra oraz znak specjalny: !@#$%^&*()_+-=\" placeholder=\"Podaj hasło\" type=\"password\" id=\"pole\" name=\"password\" size=\"15\" maxlength=\"24\"><br>
	<label id=\"div_poje_wpisu\">Potwierdz hasło*:</label><input required pattern=\"^(?=.*\d)(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\_\+\-\=])(?=.*[A-Z])(?!.*\s).{8,}$\" title=\"Wpisane hasło użytkownika musi mieć minimum osiem znaków, pośród których musi być co najmniej jedna wielka litera, jedna mała, jedna cyfra oraz znak specjalny: !@#$%^&*()_+-=\" placeholder=\"Powtórz hasło\" type=\"password\" id=\"pole\" name=\"submit_password\" size=\"15\" maxlength=\"24\"><br>
	<label id=\"div_poje_wpisu\">E-mail*:</label><input required placeholder=\"Podaj adres email\" type=\"email\" id=\"pole\" name=\"usereamil\" size=\"15\" maxlength=\"50\"><br>
	<label id=\"div_poje_wpisu\">Potwierdz E-mail*:</label><input required autocomplete=\"off\" placeholder=\"Powtórz adres email\" type=\"email\" id=\"pole\" name=\"submit_usereamil\" size=\"15\" maxlength=\"50\"><br>
	<label id=\"div_poje_wpisu\">Nazwa zespołu*:</label><input required placeholder=\"Nazwa zespołu\" type=\"text\" id=\"pole\" name=\"nazwa_zespolu\" size=\"15\" maxlength=\"50\"><br>
	<label id=\"div_poje_wpisu\">Strona WWW:</label><input placeholder=\"Nazwa strony\" type=\"url\" id=\"pole\" name=\"www_side\" size=\"15\" maxlength=\"50\"><br>
	<label id=\"div_poje_wpisu\">Numer tel.*:</label><input required pattern=\"^([0-9]{9})|(([0-9]{3}-){2}[0-9]{3})$\" title=\"Poprawny format : 123-456-789 lub 123456789\" placeholder=\"podaj numer\" type=\"tel\" id=\"pole\" name=\"tel\" size=\"15\" maxlength=\"15\"><br>
	<input type='submit' value='wyślij' class='btn' />
	</form>
	<button onclick=\"wypelnij_form()\">Click me</button>
	";
}
else
{
	echo "Wybrno formularz dla klubu";
}
	
?>