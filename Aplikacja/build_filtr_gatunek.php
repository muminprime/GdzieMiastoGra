<?php
	$wybor_gatunku = $_POST['gatunek'];// przekazanie tablicy gatunkow z index.php	
	if($wybor_gatunku=="")	//sprawdzamy czytablica jest pusta
		echo "brak";
	else
	{
		foreach($wybor_gatunku as $gatunek ) // wywolujemy petle dla kazdego elementu tablicy
		{
			if($gatunek[1]=="0") // jeseli dany element tablicy zostal nie wybrany ustawiamy checkbox_off
			{
				echo // wyswietlenie checkbox_off jako odnosnik
				"
				<a onclick=\"save_change('".$gatunek[0]."','','');\">
				<img src=\"image/inne/checkbox_off.png\" style=\"width:8%; height:1em;\">
				</a>";
			}	
			else
			{
				echo // wyswietlenie checkbox_on jako odnosnik
				"<a onclick=\"save_change('".$gatunek[0]."','','');\">
				<img src=\"image/inne/checkbox_on.png\" style=\"width:8%; height:1em;\">
				</a>";
			}	
			echo // wyswietlenie nazwy gatunku
			$gatunek[0].
			"</br>";
		}
	}	
?>