<?php

	session_start(); //aby miec dostep do sesji
	
	session_unset(); //wylaczamy sesje, zeby user mogl sie wylogowas
	
	header('Location: index.php'); //i keirujemy go na index.php

?>