<html id="main" style="font-size:10px;">
<head>
<?php include 'config.php';?> 
<!-- mta ustawia poprawne kodowanie strony dla polskich znakow-->

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" >

<!-- arkusze stylow css-->

<link rel="Stylesheet" type="text/css" href="style/main_rejestracja.css" />




<script type="text/javascript" src="jquery.js"></script>



</head>

<body >

<div id="logo" style="background-image: url('../image/<?php echo "$motyw";?>/logo.png');" ></div>
<div id="tytul" style="background-image: url('../image/<?php echo "$motyw";?>/tytul.png');" ></div>
<div id="kra_filtr"  ></div>
<div id="kra_scena"  ></div>
<div id="kra_user"  ></div>
<div id="sekcja_filtrow" style="background-image: url('../image/<?php echo "$tlo";?>/filtry.png');">
	<div id="tlo_filtr">
		<img src="image/inne/mikrofon_lewy.png" style="width:80%; height:90%; margin-top:10%;margin-left:10%;">	
	</div>
</div>
<div id="kra_lew" ></div>
<div id="scena_do_pojawiania" style="background-image: url('../image/<?php echo "$tlo";?>/scena.png');">
	<div id="nazwa_sekcji_scena">
	</div>
	<div id="formularz">
		<center><p>Wybierz rodzaj konta</p></center>
		<form>
		<div id="wybor_konta"><input id="form_user" type="radio"  name="group1" checked> Użtkowinik</div>
		<div id="wybor_konta"><input id="form_zespol" type="radio" name="group1">Zespół</div>
		<div id="wybor_konta"><input id="form_klub" type="radio" name="group1">Klub</div><br>
		</form>
		<hr>
		<div id="dane_formularza">
		</div>
	</div>
</div>
<div id="kra_pra" ></div>
<div id="uzytkownik" style="background-image: url('../image/<?php echo "$tlo";?>/panel_user.png');">
	<div id="tlo_user">
		<img src="image/inne/mikrofon_prawy.png" style="width:80%; height:90%; margin-top:10%;margin-left:10%;">	
	</div>
</div>
<div id="menu1" style="background-image: url('../image/<?php echo "$motyw";?>/menu1.png');"></div>
<div id="menu2" style="background-image: url('../image/<?php echo "$motyw";?>/menu2.png');"></div>
<div id="menu3" style="background-image: url('../image/<?php echo "$motyw";?>/menu3.png');"></div>
<div id="menu4" style="background-image: url('../image/<?php echo "$motyw";?>/menu4.png');"></div>
<div id="menu5" style="background-image: url('../image/<?php echo "$motyw";?>/menu5.png');"></div>
<div id="stopka" style="background-image: url('../image/<?php echo "$motyw";?>/stopka.png');"></div>

<script type="text/javascript">
	<?php include 'zmienne.php';?>
	
	document.getElementById("form_user").addEventListener("click", get_formularz);
	document.getElementById("form_klub").addEventListener("click", get_formularz);
	document.getElementById("form_zespol").addEventListener("click", get_formularz);

	
	
	function wypelnij_form(){
		document.getElementsByName("username")[0].value = "Janek";
		document.getElementsByName("password")[0].value = "Janek2@@";
		document.getElementsByName("submit_password")[0].value = "Janek2@@";
		document.getElementsByName("submit_usereamil")[0].value = "kowalski@o2.pl";
		document.getElementsByName("usereamil")[0].value = "kowalski@o2.pl";
		document.getElementsByName("nazwa_zespolu")[0].value = "The kowalski";
		document.getElementsByName("www_side")[0].value = "www.kowalski.pl";
		document.getElementsByName("tel")[0].value = "234-786-345";

	}
	
	// funkcja wyaswietlajaca formularz w zaleznosci od wybranego typu konta
	function get_formularz(){
		var wybor = 0;
		if(document.getElementById("form_user").checked == true)
		{
			wybor=1;
		}
		else if(document.getElementById("form_zespol").checked == true)
		{
			wybor=2;
			
		}
		else if(document.getElementById("form_klub").checked == true)
		{
			wybor=3;
		}
		$('#dane_formularza').hide();
		$.post('formularz.php', {wybor:wybor}, 
			function(output) {
				$('#dane_formularza').html(output).fadeIn(1000);
			});
	}
	
	resizetekst = function() {
		var szerokosc = document.body.clientWidth;
		var wspolczennik = 100;
		czcionka= szerokosc/wspolczennik;
		czcionka = czcionka.toString();
		document.body.style.fontSize = czcionka;		
	} //funckaj ustawiajaca wielkosc tekstu
	
	
    window.onload = function() {
		resizetekst();
		get_formularz();
		}
		
	window.onresize = function(){
		resizetekst();	
	}
</script>
</body>
</html>