<?php
	mysql_connect("localhost","root","");
	#$name = mysql_real_escape_string($_POST['name']);
	
	
	$wynik = mysql_query("SELECT * FROM database.people ");
	$wynik_num_rows = mysql_num_rows($wynik);
		
	if($wynik_num_rows==0)
		echo "Name does not exist!";
	else
	{
			
		while($data=mysql_fetch_assoc($wynik)){
		$dohtml="<center>".$data['name']." ".$data['Nazwisko']." age is ".$data['age']."</center>";
		$dohtml.="<center>and his index is ".$data['indeks']."</center><p></p>";
		echo $dohtml;	
		}
			
	}
	
?>