<?php
	$haslo = "Sieciowiec";
	echo "haslo Bazowe:<br> ".$haslo." <br>" ;
	
	$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
	echo "Haslo zahashowane: <br>".$haslo_hash;

?>