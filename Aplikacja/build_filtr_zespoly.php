<?php
	$wybor_zespolu = $_POST['zespol']; //przekazanie tablicy zespolow z index.ph
	if($wybor_zespolu=="") //sprawdzamy czytablica jest pusta
		echo "brak";
	else
	{		
		foreach($wybor_zespolu as $zespol )		// wywolujemy petle dla kazdego elementu tablicy
		{
			if($zespol[1]=="0") // jeseli dany element tablicy zostal nie wybrany ustawiamy checkbox_off
			{
				echo // wyswietlenie checkbox_off jako odnosnik
				"
				<a onclick=\"save_change('','','".$zespol[0]."');\">
				<img src=\"image/inne/checkbox_off.png\" style=\"width:8%; height:1em;\">
				</a>";
				
			}	
			else
			{
				echo // wyswietlenie checkbox_on jako odnosnik
				"<a onclick=\"save_change('','','".$zespol[0]."');\">
				<img src=\"image/inne/checkbox_on.png\" style=\"width:8%; height:1em;\">
				</a>";
			}
				
			echo // wyswietlenie nazwy gatunku
			$zespol[0].
			"</br>";
		}
	}
	
	
	
?>