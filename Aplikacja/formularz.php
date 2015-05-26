<?php
$wybor = $_POST['wybor']; 
if($wybor==1)
{
	echo "Wybrano formularz dla uzytkownika";
}
else if($wybor==2)
{
	echo "Wybrano formularz dla zespołu";
}
else
{
	echo "Wybrno formularz dla klubu";
}
	
?>