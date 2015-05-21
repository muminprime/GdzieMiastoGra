<?php
	$wybor_lokalu = $_POST['lokal'];// przekazanie tablicy lokali z index.php	
	if($wybor_lokalu=="")//sprawdzamy czytablica jest pusta
		echo "brak";
	else
	{
		foreach($wybor_lokalu as $lokal )// wywolujemy petle dla kazdego elementu tablicy
		{
			if($lokal[1]=="0")// jeseli dany element tablicy zostal nie wybrany ustawiamy checkbox_off
			{
				echo// wyswietlenie checkbox_off jako odnosnik
				"
				<a onclick=\"save_change('','".$lokal[0]."','');\">
				<img src=\"image/inne/checkbox_off.png\" style=\"width:8%; height:1em;\">
				</a>";
			}	
			else
			{
				echo// wyswietlenie checkbox_on jako odnosnik
				"<a onclick=\"save_change('','".$lokal[0]."','');\">
				<img src=\"image/inne/checkbox_on.png\" style=\"width:8%; height:1em;\">
				</a>";
			}	
			echo // wyswietlenie nazwy gatunku
			$lokal[0].
			"</br>";
		}
	}
	
	
	
?>