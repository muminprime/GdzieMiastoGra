<html id="main" style="font-size:10px;">
<head>
<?php include 'config.php';?> 
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" >
<link rel="Stylesheet" type="text/css" href="style/main.css" />
<link rel="Stylesheet" type="text/css" href="style/scena.css" />
<link rel="Stylesheet" type="text/css" href="style/filtry.css" />
<link rel="Stylesheet" type="text/css" href="style/user.css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
	<?php include 'zmienne.php';?>
	
	function get(){
		$('#scena').hide();
		$.post('data.php', {}, 
			function(output) {
				$('#scena').html(output).fadeIn(1000);
			});
		//save_change("","","");
	}
	function perform_filtering(){
		var from_date = document.getElementById('from_date').value;
		var to_date = document.getElementById('to_date').value;
		$('#scena').hide();
		$.post('filtruj.php', {gatunki_array:gatunki_array, zespoly_array: zespoly_array, lokale_array:lokale_array, from_date:from_date, to_date:to_date}, //przekazujemy do pliku filtruj.php rozne tablice oraz dwie daty
			function(output) {
				$('#scena').html(output).fadeIn(1000);
			});
	}
	
	function build_filtr_gatunek(gatunek){
		$.post('build_filtr_gatunek.php', {gatunek: gatunek}, // drugie slowko gatunek odpowiada parametrowi powyzej w nawiasach(), pierwsze to inna zmienna: do niej zostaje przypisana wartosc tej drugiej i pod ta nazwa jest przekazywane do pliku php metoda post
			function(output) {
				$('#opcje_filtra_gatunek').html(output).show();
			});
	}
	function build_filtr_lokale(lokale){
		$.post('build_filtr_lokal.php', {lokal: lokale}, 
			function(output) {
				$('#opcje_filtra_klubu').html(output).show();
			});
	}
	function build_filtr_zespoly(zespoly){
		$.post('build_filtr_zespoly.php', {zespol: zespoly}, 
			function(output) {
				$('#opcje_filtra_zespoly').html(output).show();
			});
	}
	function save_change(gatunek,lokal,zespol){
		if(gatunek!="")
		{
			for(x=0;x<gatunki_array.length;x++)
			{
				if(gatunki_array[x][0]==gatunek)
				{
					if(gatunki_array[x][1]=="0")
					{
						gatunki_array[x][1]="1";
					}
					else
					{
						gatunki_array[x][1]="0";
					}
				}
					
			}
			build_filtr_gatunek(gatunki_array);	
		}
		if(lokal!="")
		{
			for(x=0;x<lokale_array.length;x++)
			{
				if(lokale_array[x][0]==lokal)
				{
					if(lokale_array[x][1]=="0")
					{
						lokale_array[x][1]="1";
					}
					else
					{
						lokale_array[x][1]="0";
					}
				}
					
			}
			build_filtr_lokale(lokale_array);	
		}
		if(zespol!="")
		{
			for(x=0;x<zespoly_array.length;x++)
			{
				if(zespoly_array[x][0]==zespol)
				{
					if(zespoly_array[x][1]=="0")
					{
						zespoly_array[x][1]="1";
					}
					else
					{
						zespoly_array[x][1]="0";
					}
				}
					
			}
			build_filtr_zespoly(zespoly_array);	
		}
	}
	
	
	
	
	resizetekst = function() {
		var szerokosc = document.body.clientWidth;
		var wspolczennik = 100;
		czcionka= szerokosc/wspolczennik;
		czcionka = czcionka.toString();
		document.body.style.fontSize = czcionka;		
	} 
	
    window.onload = function() {
		get();
		resizetekst();
		build_filtr_gatunek(gatunki_array);
		build_filtr_lokale(lokale_array);	
		build_filtr_zespoly(zespoly_array);		
		}
		
	window.onresize = function(){
		resizetekst();	
	}
</script>

</head>

<body >

<div id="logo" style="background-image: url('../image/<?php echo "$motyw";?>/logo.png');" ></div>
<div id="tytul" style="background-image: url('../image/<?php echo "$motyw";?>/tytul.png');" ></div>
<div id="kra_filtr"  ></div>
<div id="kra_scena"  ></div>
<div id="kra_user"  ></div>
<div id="sekcja_filtrow" style="background-image: url('../image/<?php echo "$tlo";?>/filtry.png');">
	<div id="tlo_filtr">
		<div id="button_szukaj">
		<a href="javascript:perform_filtering()">
		<img src="image/inne/przycisk_szukaj.png" style="width:90%; height:65%;">
		</a>
		</div>
		<div id="opcje_filtrowania">
		<img src="image/inne/filtr_data.png" style="width:100%; height:12%;">
		<center>
		od:
		<input type="date" id="from_date" value=""><br>
		do:
		<input type="date" id="to_date" value=""><br>
		</center>
		<img src="image/inne/filtr_gatunek.png" style="width:100%; height:12%;">
			<div id="opcje_filtra_gatunek">
			</div>
		<img src="image/inne/filtr_nazwa_klubu.png" style="width:100%; height:12%;">
			<div id="opcje_filtra_klubu">
			</div>
		<img src="image/inne/filtr_nazwa_zespolu.png" style="width:100%; height:12%;">
			<div id="opcje_filtra_zespoly">
			</div>
		</div>
	</div>
</div>
<div id="kra_lew" ></div>
<div id="scena_do_pojawiania" style="background-image: url('../image/<?php echo "$tlo";?>/scena.png');">
	<div id="scena" >
	</div>
</div>
<div id="kra_pra" ></div>
<div id="uzytkownik" style="background-image: url('../image/<?php echo "$tlo";?>/panel_user.png');">
	<div id="nazwa_sekcji_user">
	</div>
	<div id="tlo_user">
		<img src="image/inne/zdjecie_user.png" style="width:64%; height:40%; border: 2px solid red;margin-top:10%;margin-left:18%;">
		<form id="form_login">
			<div id="login">Login:</div>
			<input type="text" id="username" name="username">	
			<div id="haslo">Hasło:</div>
			<input type="password" id="password" name="password">
		
			
		</form>
		
	</div>
</div>
<div id="menu1" style="background-image: url('../image/<?php echo "$motyw";?>/menu1.png');"></div>
<div id="menu2" style="background-image: url('../image/<?php echo "$motyw";?>/menu2.png');"></div>
<div id="menu3" style="background-image: url('../image/<?php echo "$motyw";?>/menu3.png');"></div>
<div id="menu4" style="background-image: url('../image/<?php echo "$motyw";?>/menu4.png');"></div>
<div id="menu5" style="background-image: url('../image/<?php echo "$motyw";?>/menu5.png');"></div>
<div id="stopka" style="background-image: url('../image/<?php echo "$motyw";?>/stopka.png');"></div>
</body>
</html>