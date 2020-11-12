<?php
	//session_start();
	//if(!isset($_SESSION['zalogowany']))
	//{
	//	header('Location: index.php');
	//	exit();
	//}

// Sprawdzam czy id istnieje before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Dołacznie pliku config
    require_once "connect.php";
    $link = mysqli_connect($host, $db_user, $db_password, $db_name);
    
	if ($link -> connect_errno) {
		  echo "Połączenie z bazą się nie powiodło " . $mysqli -> connect_error;
		  exit();
		}
	
	// Prepare statement do zapytania do bazy
    
	$sql = "SELECT * FROM (raporty LEFT JOIN utwory USING(id)) WHERE id_raport= ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Dołączenie zmiennych jako parametrów do prepared statements
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Przypisanie parametrów
        $param_id = trim($_GET["id"]);
        
        // Wykonanie prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Pobranie wyników Selecta do tablicy
                Wynik powienine zawierac jeden wiersz */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Pobranie wartosci do poszczególnych pół
				$id_raport = $row["id_raport"];
                $nazwa_raport = $row["nazwa_raport"];
                $data = $row["data"]; 
				$nazwa = $row["nazwa"];
                $tytul = $row["tytul"];
                $kompozytor = $row["kompozytor"];
				$autor = $row["autor"];
				$autorOpracowania = $row["autorOpracowania"];
				$czasTrwania = $row["czasTrwania"];
				$liczbaEmisji = $row["liczbaEmisji"];
            } else{
                // URL nie zawira id, przekirowanie na error
                echo "Problem z ifem: mysqli_num_rows result == 1 zwrocilo wiecej niz 1 wiersz";
				//header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Cos poszlo nie tak!";
			  }
    } else {
		echo "Problem z stmt calym zwrocilo 0 zmaiast 1.." ;
		
		}
     
    // Zamykamy statement
    mysqli_stmt_close($stmt);
	
	    
    // Koniec połączenia
    mysqli_close($link);
} else{
    // URL nie zawiera id, przekiruj na Error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>readRaport</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="print.css" media="print">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Zobacz jeden Raport</h1>
                    </div>
					<div class="form-group">
                        <label>L.P.</label>
                        <p class="form-control-static"><?php echo $row["id_raport"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nazwa raportu</label>
                        <p class="form-control-static"><?php echo $row["nazwa_raport"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nazwa pliku utworu</label>
                        <p class="form-control-static"><?php echo $row["nazwa"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tytuł</label>
                        <p class="form-control-static"><?php echo $row["tytul"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Kod ISRC</label>
                        <p class="form-control-static"><?php echo $row["kodISRC"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Kompozytor</label>
                        <p class="form-control-static"><?php echo $row["kompozytor"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Autor</label>
                        <p class="form-control-static"><?php echo $row["autor"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Autor Opracowania</label>
                        <p class="form-control-static"><?php echo $row["autorOpracowania"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Czas Trwania</label>
                        <p class="form-control-static"><?php echo $row["czasTrwania"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Data wprowadzenia</label>
                        <p class="form-control-static"><?php echo $row["data"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Liczba Emisji</label>
                        <p class="form-control-static"><?php echo $row["liczbaEmisji"]; ?></p>
                    </div>
             
										
                    <p><a href="noLogin.php" class="btn btn-primary" id="back-btn">Wróć</a></p>
					<button onclick="window.print();" class="btn btn-primary" id="print-btn">Drukuj raport!</button>
                </div>
            </div>        
         
		</div>
    </div>
</body>
</html>