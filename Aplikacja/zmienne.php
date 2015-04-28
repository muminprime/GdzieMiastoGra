<?php
	mysql_connect("localhost","root","");
	#$name = mysql_real_escape_string($_POST['name']);
	//echo $wybor_gatunku.$wybor_lokalu.$wybor_zespolu;
	
	
	
	//ponizszy blok trzeba skopiowac dla wszystkich mozliwosci filtrowania (kluby, zespoly, daty itp)
	$gatunki = mysql_query("SELECT 	gatunki.id as 'id', gatunki.nazwa as 'nazwa_gatunku'
							FROM database.gatunki");
	$lokale = mysql_query("SELECT 	lokale.id as 'id', lokale.nazwa as 'nazwa_lokalu'
							FROM database.lokale");
	$zespoly = mysql_query("SELECT 	zespoly.id as 'id', zespoly.nazwa as 'nazwa_zespolu'
							FROM database.zespoly");						
	$gatunki_num_rows = mysql_num_rows($gatunki);
	$lokale_num_rows = mysql_num_rows($lokale);
	$zespoly_num_rows = mysql_num_rows($zespoly);
	if($gatunki_num_rows==0)
		echo "Brak";
	else
	{ 
		while($data=mysql_fetch_assoc($gatunki))
			$gatunki_array[] = array($data['nazwa_gatunku'],"0"); // dodaj do tablicy string
	}
	if($zespoly_num_rows==0)
		echo "Brak";
	else
	{ 
		while($data=mysql_fetch_assoc($zespoly))
			$zespoly_array[] = array($data['nazwa_zespolu'],"0"); // dodaj do tablicy string
	}
	if($lokale_num_rows==0)
		echo "Brak";
	else
	{ 
		while($data=mysql_fetch_assoc($lokale))
			$lokale_array[] = array($data['nazwa_lokalu'],"0"); // dodaj do tablicy string
	}
	echo "var gatunki_array = [];" ;
	$i =0;
	foreach($gatunki_array as $gatunek)
	{
		echo "gatunki_array[".$i."]=['".$gatunek[0]."','".$gatunek[1]."'];";
		$i=$i+1;
	}
	echo "var lokale_array = [];" ;
	$i =0;
	foreach($lokale_array as $gatunek)
	{
		echo "lokale_array[".$i."]=['".$gatunek[0]."','".$gatunek[1]."'];";
		$i=$i+1;
	}
	echo "var zespoly_array = [];" ;
	$i =0;
	foreach($zespoly_array as $gatunek)
	{
		echo "zespoly_array[".$i."]=['".$gatunek[0]."','".$gatunek[1]."'];";
		$i=$i+1;
	}
?>