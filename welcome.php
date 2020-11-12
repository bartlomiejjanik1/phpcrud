<!doctype html>
<html lang="pl">

<?php
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>


<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico"
	
	<!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/welcome.css" rel="stylesheet">
</head>

<body>
	
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">System Raportowania</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="Dokumentacja.pdf" target="_blank">Dokumentacja</a>
        <a class="p-2 text-dark" href="reset-password.php">Zmiana hasla</a>
      </nav>
      <a class="btn btn-outline-primary" href="logout.php">Wyloguj się</a>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4"><?php echo "<p>Witaj ".$_SESSION['username'].'!</p>'; ?></h1>
      <p class="lead">System raportowania utworów muzycznych powstał w ramach zajęć "Zaawansowane Aplikacjie Internetowe" na studiach OKNO.<br> Wybierz jedną z poniższych opcji, aby uruchomić odpowiedni moduł aplikacji.</p>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Edytor bazy utworów</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Dodawanie utworów</li>
              <li>Edycja utworów</li>
              <li>Usuwanie support</li>
              <li>Kliknij poniżej, aby rozpocząć!</li>
            </ul>
		    <a class="btn btn-lg btn-block btn-outline-primary" href="utwory.php">Rozpocznij!</a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Edytor Raportów</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Tworzenie raportów</li>
              <li>Edytowanie raportów</li>
              <li>Usuwanie raportów</li>
              <li>Kliknij poniżej, aby rozpocząć!</li>
            </ul>
            <a class="btn btn-lg btn-block btn-primary" href="raporty.php">Rozpocznij!</a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Przeglądarka zasobów</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Przeglądaj listę utworów</li>
              <li>Przeglądaj raporty</li>
              <li>Brak możliwości edycji!</li>
              <li>Kliknij poniżej, aby rozpocząć!</li>
            </ul>
		    <a type="submit" class="btn btn-lg btn-block btn-primary" href="viewer.php">Rozpocznij!</a>
		
          </div>
        </div>
      </div>

      <footer class="footer border-top">
        <div class="row">
          <div class="col-12 col-md">
            <div class="col-6 col-md">
            <h5>Bartlomiej Janik</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="https://www.pw.edu.pl/" target="_blank" >Politechnika Warszawska</a></li>
			  <small class="d-block mb-3 text-muted">&copy; 2020 </small>
              </ul>
          </div>
        </div>
      </footer>
    </div>


      

</body>
</html>