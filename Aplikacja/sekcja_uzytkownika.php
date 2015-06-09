<script type="text/javascript">
	function zaloguj(){
		var login = document.getElementById('username').value;
		var haslo = document.getElementById('password').value;
		$.post('loguj.php', {login:login, haslo:haslo},
			function(output){
				//$('#scena').html(output);
				alert(output);
				if (output=="Zalogowano!")
					window.location.reload(); // jesli sie uda request, to odswiez cala strone
			}
		);
	}
	
	function wyloguj(){ // pewnie da sie to jakos prosciej
		$.post('wyloguj.php', {},
			function(){
				window.location.reload();
			}
		);
	}
	
</script>

<?php

	if (!isset($_COOKIE['uzytkownik'])) // jesli nie ma ciasteczka uzytkownika, to zaladuj defaultowa strone
	{
		
		echo "
		<div id=\"nazwa_sekcji_user\">
			</div>
			<div id=\"tlo_user\">
				<img src=\"image/inne/zdjecie_user.png\" style=\"width:64%; height:40%; border: 2px solid red;margin-top:10%;margin-left:18%;margin-right:18%;\">
				<center>
				<label id=\"Login\">Login:</label><input type=\"text\" id=\"username\" name=\"username\"></br>
				<label id=\"Haslo\">Hasło:</label><input type=\"password\" id=\"password\" name=\"password\"></br>
				</center>
				<div id=\"for_chackbox\">
				<input type=\"checkbox\" name=\"vehicle\" value=\"Bike\" style=\"cursor: pointer;\"> 
				Zapamiętaj mnnie
				<a href=\"\" style=\"text-align:left;\"><label id=\"forget\">Zapomniałem hasła !!</label></a>
				<a href=\"javascript:zaloguj()\"><img src=\"image/inne/button_loguj.png\" style=\"width:64%; height:12%;margin-top:3%;margin-left:18%;margin-right:18%;\"></a>
				<a href=\"rejestracja.php\"><img src=\"image/inne/button_zarejestruj.png\" style=\"width:64%; height:12%;margin-top:6%;margin-left:18%;margin-right:18%;\"></a>
				</div>
			</div>"; 
	}
	else // jesli jest ciastko, to zaladuj inaczej
	{
		mysql_connect("localhost","root","");
		$lgn = $_COOKIE['uzytkownik'];
		if ($zapytanie = mysql_query("SELECT u.login, du.data_urodzenia FROM `database`.uzytkownicy u, `database`.dane_uzytkownika du WHERE u.dane_uzytkownika_id=du.id AND u.login='".$lgn."'"))
		$data_urodzenia = mysql_fetch_assoc($zapytanie)['data_urodzenia'];	
	else
		$data_urodzenia = "błąd w zapytaniu";
	if ($zapytanie = mysql_query("SELECT u.login, du.ulubione_gatunki_id 
																FROM `database`.uzytkownicy as u, `database`.dane_uzytkownika as du 
																WHERE u.dane_uzytkownika_id=du.id 
																AND u.login='".$lgn."'")) // to zapytanie zwraca nam jeden rekord z kolumna "login" i "ulubione_gatunki_id"
	{
		$ind_do_tabeli_ulubione_gatunki = mysql_fetch_assoc($zapytanie)['ulubione_gatunki_id']; // zapisujemy sobie pod zmienną id do tabeli ulubione_gatunki
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
														ON g.id=T2.id_gatunkow"); // to nie jest zbyt piękne, ale działa; w sumie nie musisz się tym przejmować, bo wszystko się dzieje automatycznie
														//zapytanie to zwraca tabelkę z jedną kolumną "nazwa", gdzie w oddzielnych wierszach są gatunki wybrane przez użytkownika o wcześniej wybranym loginie
$gatunki_str ="";
$i = 1;														
		while ($data = mysql_fetch_assoc($gatunki))
		{
			if($i>=2)$gatunki_str = $gatunki_str.", ";
			$gatunki_str =$gatunki_str.$data['nazwa'];
			$i=$i+1;
		}
	}
														
		echo"
			<div id=\"tlo_user_po_zalogowaniu\">
				<div id=\"powitanie\"><center>Witaj ".$_COOKIE['uzytkownik']."!!</center></div>
				<img src=\"image/inne/zdjecie_user_log_in.png\" style=\"width:64%; height:35%; border: 2px solid red;margin-top:5%;margin-left:18%;margin-right:18%;\">
				<div id=\"info_user\">
				<center>
				Data urodzenia:<font color=\"red\"> ".$data_urodzenia."<br></font>
				Ulobione gatunki:<br><font color=\"red\"> ".$gatunki_str."</font>
				</center>
				</div>
				<div id=\"wyloguj\">
				<a href=\"javascript:wyloguj()\" style=\"text-align:left;\"><img src=\"image/inne/wyloguj.png\" style=\"width:64%; height:100%;margin-top:3%;margin-left:18%;margin-right:18%;\"></a>
				</div>
			</div>"; 
		
		
	}
?>
