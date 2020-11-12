<?php
	session_start(); //funkcja do wykorzystania sesji (przesyałania wartosci zmiennych miedzy plikami php)
		if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	require_once "connect.php"; //dolaczenie pliku z ustawieniami połączenia z baza danych

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	//obsluga bledu
	if ($polaczenie->connect_errno!=0) //lepiej 
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8"); //encje html,do sanityzacji kodu abu nie wykonac javascriptu w przgladarce oraz ochronic przed sql injection
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE username='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
				{
			$ilu_userow = $rezultat->num_rows; //num_rows liczba zwroconych wierszy
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc(); //tworzy tablice asocjacyjna, ktora przechowa pobrane z bazy wiersz w zmiennej $wiersz
				
				if (password_verify($haslo,$wiersz['password']))
				{
					$_SESSION['zalogowany']= true; //jak znajdzie usera to ustawi zmienna 'zalogowany'
					$_SESSION['id']=$wiersz['id']; //pobieramy id usera z bazy, ktory sie zalgowal
					$_SESSION['username'] = $wiersz['username']; //do zmiennej $user przypisalismy zawartosc z tablicy otrzymanej wyzej z bazy. 
									
					unset($_SESSION['blad']);
					$rezultat->free_result(); //zwolnij pamiec bo pobraniu danych do tablicy
					header('Location: welcome.php');
				}
				 else 
				{
					$_SESSION['blad']='<span class="help-block" style="color:red"> <br><br> Zle Haslo!</span>';
					header('Location: index.php');
				}
				
			} else {
				
				$_SESSION['blad']='<span class="help-block" style="color:red"> <br /><br> Zly login lub haslo!</span>';
				header('Location: index.php');
				
				}
			
		}
	}
		$polaczenie->close(); //zamykamy polaczenie
?>