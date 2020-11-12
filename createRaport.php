<?php

 //Sprawdzamy czy user jest zalogowany
 session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
// Dołacznie pliku config
	require_once "connect.php";
	// Połączenie z baza appdatabase
	$link = mysqli_connect($host, $db_user, $db_password, $db_name);
// Definicja i inicjalizacja zmiennych bez wartości
$nazwa_raport = $tytul = $liczbaEmisji = $data =  $autorOpracowania = $czasTrwania = $id = "";
$nazwa_raport_err = $tytul_err = $liczbaEmisji_err = $data_err = $autorOpracowania_err = $czasTrwania_err = $id_err = "";
 
// Przetwarzanie formularza po zaiwerdzieniu
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Wpisz nazwe raportu
    $input_nazwa_raport = trim($_POST["nazwa_raport"]);
    if(empty($input_nazwa_raport))
	{
		$nazwa_raport_err = "Wpisz nazwe!";
    } else{
        $nazwa_raport = $input_nazwa_raport;
    }
    
    // Walidacja id piosenki czy zostalo przekazane
    $input_id = trim($_POST["id"]);
     if(empty($input_id)){
        $id_err = "Nie przekazalo id piosenki z tbaeli Utwory!.";     
		} else{
			$id = $input_id;
		}
    // Walidacja liczbaEmisji
    $input_liczbaEmisji = trim($_POST["liczbaEmisji"]);
    if(empty($input_liczbaEmisji)){
        $liczbaEmisji_err = "Wpisz liczbe Emisji!!";     
    } else{
        $liczbaEmisji = $input_liczbaEmisji;
    }  

	// Walidacja data
    $input_data = trim($_POST["data"]);
    if(empty($input_data)){
        $data_err = "Wpisz date!";     
    } else{
        $data = $input_data;
    }

    // Sprawdzenie błędów przed wykonaniem zapytania do bazy danych
	if(empty($nazwa_raport_err) && empty($liczbaEmisji_err) && empty($data_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO raporty (nazwa_raport, data, liczbaEmisji, id ) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Dołączenie zmiennych jako parametrów do prepared statements
            mysqli_stmt_bind_param($stmt, "ssss", $param_nazwa_raport, $param_data, $param_liczbaEmisji, $param_id );
            
            // Przypisanie parametrów
            $param_nazwa_raport = $nazwa_raport;
			$param_data = $data;
			$param_liczbaEmisji = $liczbaEmisji;
			$param_id = $id;
      
            // Wykonanie prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: raporty.php");
                exit();
            } else{
                echo "Cos poszlo nie tak!";
            }
        }
         
        // Zamykamy statement
        mysqli_stmt_close($stmt);
    }
    
    // Koniec połączenia
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                        <h2>Dodaj Raport </h2>
                    </div>
                    <p>Wypełnij poniższyc formularz, aby dodać nowy Raport.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
						<div class="form-group <?php echo (!empty($nazwa_raport_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa Raportu </label>
                            <input type="text" name="nazwa_raport" class="form-control" value="<?php echo $nazwa_raport; ?>">
                            <span class="help-block"><?php echo $nazwa_raport_err;?></span>
                        </div>
                       
						<div class="form-group <?php echo (!empty($data_err)) ? 'has-error' : ''; ?>">
                            <label>Data - podaj date kiedy liczba emisji jest zanotowana</label>
                            <input type="date" name="data" class="form-control" value="<?php echo $data; ?>">
                            <span class="help-block"><?php echo $data_err;?></span>
                        </div>
						
						<div class="form-group">
                            <label>Tytul Utworu</label>
							<select id ="id" name="id"  class="form-control"  >
							<?php 
							$sql1 = "SELECT id, tytul FROM utwory";
							if($result1 = mysqli_query($link, $sql1)){
								while($row1 = mysqli_fetch_array($result1)){
									echo '<option value= "'.$row1["id"] .'" >'.$row1["tytul"].'</option>';
									}
							}
									?>
							</select>
							</div>
						
                        <div class="form-group <?php echo (!empty($liczbaEmisji_err)) ? 'has-error' : ''; ?>">
                            <label>Podaj liczbe emisji</label>
                            <input type="text" name="liczbaEmisji" class="form-control" value="<?php echo $liczbaEmisji; ?>">
                            <span class="help-block"><?php echo $liczbaEmisji_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Dodaj!">
                        <a href="raporty.php" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>