<?php
mysql_connect("localhost","root","");
$gatunki = mysql_query("SELECT 	gatunki.id as 'id', gatunki.nazwa as 'nazwa_gatunku'
							FROM database.gatunki");
$gatunki_num_rows = mysql_num_rows($gatunki);
$wybor = $_POST['wybor']; 
if($wybor==1)
{
	echo "
	
	<form>
	<label id=\"div_poje_wpisu\">Login*:</label><input required title=\"Login może miec maksymalnie 20 znakow. Musi zaczynać się od malej litery, dużej litery lub cyfry. Może zawierac symbole: _ - \" pattern=\"^([a-zA-Z0-9]{1})([a-zA-Z0-9_-]{2,20})$\" placeholder=\"Podaj login\" type=\"text\" id=\"pole\" name=\"username\" size=\"15\" maxlength=\"20\"><br>
	<label id=\"div_poje_wpisu\">Hasło*:</label><input required pattern=\"^(?=.*\d)(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\_\+\-\=])(?=.*[A-Z])(?!.*\s).{8,}$\" title=\"Wpisane hasło użytkownika musi mieć minimum osiem znaków, pośród których musi być co najmniej jedna wielka litera, jedna mała, jedna cyfra oraz znak specjalny: !@#$%^&*()_+-=\" placeholder=\"Podaj hasło\" type=\"password\" id=\"pole\" name=\"password\" size=\"15\" maxlength=\"24\"><br>
	<label id=\"div_poje_wpisu\">Potwierdz hasło*:</label><input required pattern=\"^(?=.*\d)(?=.*[a-z])(?=.*[\!\@\#\$\%\^\&\*\(\)\_\+\-\=])(?=.*[A-Z])(?!.*\s).{8,}$\" title=\"Wpisane hasło użytkownika musi mieć minimum osiem znaków, pośród których musi być co najmniej jedna wielka litera, jedna mała, jedna cyfra oraz znak specjalny: !@#$%^&*()_+-=\" placeholder=\"Powtórz hasło\" type=\"password\" id=\"pole\" name=\"submit_password\" size=\"15\" maxlength=\"24\"><br>
	<label id=\"div_poje_wpisu\">E-mail*:</label><input required placeholder=\"Podaj adres email\" type=\"email\" id=\"pole\" name=\"usereamil\" size=\"15\" maxlength=\"50\"><br>
	<label id=\"div_poje_wpisu\">Potwierdz E-mail*:</label><input required autocomplete=\"off\" placeholder=\"Powtórz adres email\" type=\"email\" id=\"pole\" name=\"submit_usereamil\" size=\"15\" ><br>
	<label id=\"div_poje_wpisu\">Data urodzenia*:</label><input required type=\"date\" id=\"pole\" name=\"bday\" autocomplete=\"off\" size=\"15\"><br>
	<label id=\"div_poje_wpisu\">Wybierz ulubione gatunki muzyki:</label><br><br>";
	if($gatunki_num_rows==0)
		echo "Brak";
	else
	{
		$i=0;
		while($data=mysql_fetch_assoc($gatunki))
		{
			echo "<div id=\"checkbox_set\" ><input id=\"pole\" type=\"checkbox\" name=\"".$data['nazwa_gatunku']."\" >".$data['nazwa_gatunku']."</div>";

		}
				
	}
	echo"<div id=\"regulamin\"><center>regulamin strony</center>";
	echo"
	</div>
	<div id=\"checkbox_regulamin\"><input type=\"checkbox\" name=\"regulamin\" required> akceptuje regulamin</div>
	<div id=\"submit_button\"><input type='submit' value='rejestruj' class='btn' /></div>
	</form>
	<button onclick=\"wypelnij_form()\">Click me</button>
	<div id=\"akceptuj\">* - pola wymagane</div>
	";
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