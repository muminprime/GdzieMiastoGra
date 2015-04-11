<html>
<head>
<?php include 'config.php';
$cos="tlo_nie"; ?> 
<link rel="Stylesheet" type="text/css" href="style/main.css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
	var motyw="Motyw_cz";
	function get(){
		$('#scena').hide();
		$.post('data.php', {}, 
			function(output) {
				$('#scena').html(output).fadeIn(1000);
			});
	}

</script>

</head>

<body >

<div id="logo" style="background-image: url('../image/<?php echo "$motyw";?>/logo.png');" ></div>
<div id="tytul" style="background-image: url('../image/<?php echo "$motyw";?>/tytul.png');" ></div>
<div id="kra_filtr" style="background-image: url('../image/<?php echo "$tlo";?>/kra_filtr.png');" ></div>
<div id="kra_scena" style="background-image: url('../image/<?php echo "$tlo";?>/kra_scena.png');" ></div>
<div id="kra_user" style="background-image: url('../image/<?php echo "$tlo";?>/kra_user.png');" ></div>
<div id="sekcja_filtrow" style="background-image: url('../image/<?php echo "$tlo";?>/filtry.png');">
</br>
</br>
</br>
<center><input type="button" value="Pokaż koncerty" onClick="get();"/></center>

</div>
<div id="kra_lew" style="background-image: url('../image/<?php echo "$tlo";?>/kra_lew.png');"></div>
<div id="scena_do_pojawiania" style="background-image: url('../image/<?php echo "$tlo";?>/scena.png');">
	<div id="scena" >
	</div>
</div>
<div id="kra_pra" style="background-image: url('../image/<?php echo "$tlo";?>/kra_pra.png');"></div>
<div id="uzytkownik" style="background-image: url('../image/<?php echo "$tlo";?>/panel_user.png');"></div>
<div id="menu1" style="background-image: url('../image/<?php echo "$motyw";?>/menu1.png');"></div>
<div id="menu2" style="background-image: url('../image/<?php echo "$motyw";?>/menu2.png');"></div>
<div id="menu3" style="background-image: url('../image/<?php echo "$motyw";?>/menu3.png');"></div>
<div id="menu4" style="background-image: url('../image/<?php echo "$motyw";?>/menu4.png');"></div>
<div id="menu5" style="background-image: url('../image/<?php echo "$motyw";?>/menu5.png');"></div>
<div id="stopka" style="background-image: url('../image/<?php echo "$motyw";?>/stopka.png');"></div>
</body>
</html>