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
		echo"
		<div id=\"nazwa_sekcji_user\">
			</div>
			<div id=\"tlo_user\">
				<h1>Witaj ".$_COOKIE['uzytkownik']."</h1>
				<img src=\"image/inne/zdjecie_user.png\" style=\"width:64%; height:40%; border: 2px solid red;margin-top:10%;margin-left:18%;margin-right:18%;\">
				<div id=\"for_chackbox\">
				<a href=\"javascript:wyloguj()\" style=\"text-align:left;\"><label id=\"forget\">Wyloguj</label></a>
				</div>
			</div>"; 
		
		
	}
?>
