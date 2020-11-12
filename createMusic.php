<?php
	require_once "connect.php";
	//Połączenie do bazy danych appdatabase
	$link = mysqli_connect($host, $db_user, $db_password, $db_name);
// Definicja i inicjalizacja zmiennych bez wartości
$nazwa = $tytul = $kodISRC = $kompozytor = $autor = $autorOpracowania = $czasTrwania ="";
$nazwa_err = $tytul_err = $kodISRC_err = $kompozytor_err = $autor1_err = $autorOpracowania_err = $czasTrwania_err ="";
 
// Przetwarzanie formularza po zatwierdzeniu Dodaj!
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	// Walidacja Wpisz nazwe pliku
    $input_nazwa = trim($_POST["nazwa"]);
    if(empty($input_nazwa))
	{
		$nazwa_err = "Wpisz nazwe!";
    } else{
        $nazwa = $input_nazwa;
    }
    
    // Walidacja Wpisz tytul utworu
    $input_tytul = trim($_POST["tytul"]);
    if(empty($input_tytul)){
        $tytul_err = "Wpisz Tytul.";     
    } else{
        $tytul = $input_tytul;
    }
    
    // Walidacja kodISRC
    $input_kodISRC = trim($_POST["kodISRC"]);
    if(empty($input_kodISRC)){
        $kodISRC_err = "Wpisz kod ISRC!";     
    } elseif(strlen(trim($_POST["kodISRC"])) < 20){
			$kodISRC_err = "Kod ISRC musi miec minimum 20 znaków!";
	} else {
        $kodISRC = $input_kodISRC;
    }
    
	// Walidacja kompozytor
    $input_kompozytor = trim($_POST["kompozytor"]);
    if(empty($input_kompozytor)){
        $kompozytor_err = "Wpisz nazwisko kompozytora";     
    } else{
        $kompozytor = $input_kompozytor;
    }
	
	// Walidacja autor
    $input_autor = trim($_POST["autor"]);
    if(empty($input_autor)){
        $autor1_err = "Wpisz nazwisko autora";     
    } else{
        $autor = $input_autor;
    }
	
	// Walidacja autorOpracowania
    $input_autorOpracowania = trim($_POST["autorOpracowania"]);
    if(empty($input_autorOpracowania)){
        $autorOpracowania_err = "Wpisz nazwisko autora opracowania";     
    } else{
        $autorOpracowania = $input_autorOpracowania;
    }
	
	// Walidacja czasTrwania
    $input_czasTrwania = trim($_POST["czasTrwania"]);
    if(empty($input_czasTrwania)){
        $czasTrwania_err = "Wpisz czas trwania w sekundach";     
    } else{
        $czasTrwania = $input_czasTrwania;
    }
	
    // Sprawdznei błędów prze Insertem do bazy
    if(empty($nazwa_err) && empty($tytul_err) && empty($kodISRC_err) && empty($kompozytor_err) && empty($autor1_err) && empty($autorOpracowania_err) && empty($czasTrwania_err) ){
        // Insert statement
        $sql = "INSERT INTO utwory (nazwa, tytul, kodISRC, kompozytor, autor, autorOpracowania, czasTrwania) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Dołączenie zmiennych jako parametrów do prepared statements
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_tytul, $param_kodISRC, $param_kompozytor, $param_autor, $param_autorOpracowania, $param_czasTrwania);
            
            // Przypisanie parametrów
            $param_name = $nazwa;
            $param_tytul = $tytul;
            $param_kodISRC = $kodISRC;
			$param_kompozytor = $kompozytor;
			$param_autor = $autor;
			$param_autorOpracowania = $autorOpracowania;
			$param_czasTrwania = $czasTrwania;
            
            // Wykonanie prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: utwory.php");
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
<html lang="en">
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
                        <h2>Dodaj utwór</h2>
                    </div>
                    <p>Wypełnij poniższyc formularz, aby dodać utwór do Bazy Utoworów.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nazwa_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa pliku</label>
                            <input type="text" name="nazwa" class="form-control" value="<?php echo $nazwa; ?>">
                            <span class="help-block"><?php echo $nazwa_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tytul_err)) ? 'has-error' : ''; ?>">
                            <label>Tytul</label>
                            <input type="text" name="tytul" class="form-control" value="<?php echo $tytul; ?>">
                            <span class="help-block"><?php echo $tytul_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($kodISRC_err)) ? 'has-error' : ''; ?>">
                            <label>kodISRC</label>
                            <input type="text" name="kodISRC" class="form-control" value="<?php echo $kodISRC; ?>">
                            <span class="help-block"><?php echo $kodISRC_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($kompozytor_err)) ? 'has-error' : ''; ?>">
                            <label>Kompozytor</label>
                            <input type="text" name="kompozytor" class="form-control" value="<?php echo $kompozytor; ?>">
                            <span class="help-block"><?php echo $kompozytor_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($autor1_err)) ? 'has-error' : ''; ?>">
                            <label>Autor</label>
                            <input type="text" name="autor" class="form-control" value="<?php echo $autor; ?>">
                            <span class="help-block"><?php echo $autor1_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($autorOpracowania_err)) ? 'has-error' : ''; ?>">
                            <label>Autor Opracowania</label>
                            <input type="text" name="autorOpracowania" class="form-control" value="<?php echo $autorOpracowania; ?>">
                            <span class="help-block"><?php echo $autorOpracowania_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($czasTrwania_err)) ? 'has-error' : ''; ?>">
                            <label>Czas Trwania</label>
                            <input type="number" min="1" max="600" name="czasTrwania" class="form-control" value="<?php echo $czasTrwania; ?>">
                            <span class="help-block"><?php echo $czasTrwania_err;?></span>
                        </div>
						
                        <input type="submit" class="btn btn-primary" value="Dodaj!">
                        <a href="utwory.php" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>