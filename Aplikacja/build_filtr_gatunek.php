<?php
	mysql_connect("localhost","root","");
	#$name = mysql_real_escape_string($_POST['name']);
	$wybor_gatunku = $_POST['gatunek'];
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
			$zespoly_array[] = $data['nazwa_zespolu']; // dodaj do tablicy string
	}
	if($lokale_num_rows==0)
		echo "Brak";
	else
	{ 
		while($data=mysql_fetch_assoc($lokale))
			$lokale_array[] = $data['nazwa_lokalu']; // dodaj do tablicy string
	}
	if($wybor_gatunku!="")
	{
		$i=0;
		foreach($gatunki_array as $a )
		{		
			$gatunki_array[$i][1]=$wybor_gatunku[$i][1];
			$i=$i+1;
		}
	}
	
	foreach($gatunki_array as $gatunek )
	{
		if($gatunek[1]=="0")
		{
			echo
			"
			<a onclick=\"save_change('".$gatunek[0]."','','');\">
			<img src=\"image/inne/checkbox_off.png\" style=\"width:8%; height:1em;\">
			</a>";
			
		}	
		else
		{
			echo
			"<a onclick=\"save_change('".$gatunek[0]."','','');\">
			<img src=\"image/inne/checkbox_on.png\" style=\"width:8%; height:1em;\">
			</a>";
		}
			
		echo
		$gatunek[0].
		"</br>";
	}
	
	
?>