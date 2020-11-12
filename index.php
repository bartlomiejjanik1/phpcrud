<?php
	//Sprawdzamy czy user jest zalogowany, jak nie to na strone logowania 
	session_start();
		if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)) 
	{
		header('Location: welcome.php');
		exit(); 
	} //jesli istnieje zmienna zalogowany i jest na true to kieruj do welcome.php
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title> ####Projekt1 PW CrazyColors222!!!!!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<style type="text/css">
        html, body{
    	padding: 0;
    	margin:0;
    	height: 100%; 
		font: 14px sans-serif;
		}
        .wrapper{  padding: 20px; width: 30%;
		margin: 0 auto;
		position: relative;
		max-width: 1024px; }
		.btn-primary { float: left; }
			.btn-info { float: right; }
		
    </style> 
</head>
<body>
	<div class="wrapper">
		<div class="text-center mb-4">
			<img class="mb-4" src="logo.png" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">System raportowania utworów muzycznych</h1>
			</br> 
		</div>
	<form action="zaloguj.php" method="post">
		<label>Login: </label> <br /> <input type="text" name="login" class="form-control" required="" autofocus=""/> <br />
		<label>Haslo: </label> <br /> <input type="password" name="haslo" class="form-control" required="" /> <br /><br />
		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Zaloguj się" />
	</form>
	<form action="noLogin.php" method="post">
		<input type="submit" class="btn btn-info"  value="Kontynuuj bez logowania" />
	</form>
	</div>
</body>
</html>

<?php
	if(isset($_SESSION['blad'])) //jesli zmienna blad jest ustawiona (czyli zly login) to zwroci echo z tym bledem
		echo $_SESSION['blad'];
	?>
