<?php
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	// Dołacznie pliku config
		include "connect.php";
		// Połączenie z baza appdatabase
		$link = mysqli_connect($host, $db_user, $db_password, $db_name);

	// Definicja i inicjalizacja zmiennych bez wartości
	$nazwa_raport = $data = $liczbaEmisji = $data =  $autorOpracowania = $czasTrwania = "";
	$nazwa_raport_err = $data_err = $liczbaEmisji_err = $data_err = $autorOpracowania_err = $czasTrwania_err = $id_err = $id_raport_err = "";
	 
	// Przetwarzanie formularza po zaiwerdzieniu
	if(isset($_POST["id_raport"]) && !empty($_POST["id_raport"])){   
	// Get hidden input value
    $id_raport = $_POST["id_raport"];
	$id = $_POST["id"];
	
    // Wpisz nazwe raportu
    $input_nazwa_raport = trim($_POST["nazwa_raport"]);
    if(empty($input_nazwa_raport))
	{
		$nazwa_raport_err = "Wpisz nazwe!";
    } else{
        $nazwa_raport = $input_nazwa_raport;
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
    if(empty($nazwa_raport_err) && empty($data_err) && empty($liczbaEmisji_err) && empty($id_err) ){
        // Prepare an update statement
        $sql = "UPDATE raporty SET nazwa_raport=?, data=?, liczbaEmisji=?, id=? WHERE id_raport=?"; 
		 
        if($stmt = mysqli_prepare($link, $sql)){
            // Dołączenie zmiennych jako parametrów do prepared statements
            mysqli_stmt_bind_param($stmt, "sssii", $param_nazwa_raport, $param_data, $param_liczbaEmisji, $param_id, $param_id_raport);
            
            // Przypisanie parametrów
            $param_nazwa_raport = $nazwa_raport;
			$param_data = $data;
			$param_liczbaEmisji = $liczbaEmisji;
			$param_id = $id;
			$param_id_raport = $id_raport;
			
            
            // Wykonanie prepared statement
            if(mysqli_stmt_execute($stmt)){
                
                //echo "powinno przekeirowac do raporty.php teraz";
				header("location: raporty.php");
                exit();
            } else{
                echo "Something went wrong. UPDATE??";
            }
        }
         
        // Zamykamy statement
        mysqli_stmt_close($stmt);
    }
    
    // Koniec połączenia
    mysqli_close($link);
} 
	else{
    // Sprawdzam czy id istnieje 
    if(isset($_GET["id_raport"]) && !empty(trim($_GET["id_raport"]))){
        // Get URL parameter
        $id_raport =  trim($_GET["id_raport"]);
        
        // Prepare statement do zapytania do bazy
        $sql = "SELECT * FROM raporty WHERE id_raport = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Dołączenie zmiennych jako parametrów do prepared statements
            mysqli_stmt_bind_param($stmt, "i", $param_id_raport);
            
            // Przypisanie parametrów
            $param_id_raport = $id_raport;
            
            // Wykonanie prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Pobranie wyników Selecta do tablicy
                    Wynik powienine zawierac jeden wiersz */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Pobranie wartosci do poszczególnych pół
                    $nazwa_raport = $row["nazwa_raport"];
					$data = $row["data"];
					$liczbaEmisji = $row["liczbaEmisji"];
					
				} else {
						// URL nie ma id, przekeiruj do error page
						echo "zle pobralo dane z stmt select from raporty";
						//header("location: error.php");
						exit();
					}
                
            } else
					{
						echo "Oops! Cos poszlo nie tak!";
					}
		} 
        
        // Zamykamy statement
        mysqli_stmt_close($stmt);
        
        // Koniec połączenia
        //mysqli_close($link);
		} else 
			{
				// URL nie zawiera id, przekiruj na Error page
				echo "prepare link?";
				//header("location: error.php");
				exit();
			}	   
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
                        <h2>Edycja Raportu </h2>
                    </div>
                    <p>Edytuj poniższyc formularz, aby wyedytować Raport.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
						<div class="form-group <?php echo (!empty($nazwa_raport_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa Raportu</label>
                            <input type="text" name="nazwa_raport" class="form-control" value="<?php echo $nazwa_raport; ?>">
                            <span class="help-block"><?php echo $nazwa_raport_err;?></span>
                        </div>

						<div class="form-group <?php echo (!empty($data_err)) ? 'has-error' : ''; ?>">
                            <label>Data - podaj date kiedy liczba emisji jest zanotowana</label>
                            <input type="date" name="data" class="form-control" value="<?php echo $data; ?>">
                            <span class="help-block"><?php echo $data_err;?></span>
                        </div>
						
						<div class="form-group <?php echo (!empty($liczbaEmisji_err)) ? 'has-error' : ''; ?>">
                            <label>Liczba Emisji</label>
                            <input type="text" name="liczbaEmisji" class="form-control" value="<?php echo $liczbaEmisji; ?>">
                            <span class="help-block"><?php echo $liczbaEmisji_err;?></span>
                        </div>
						
							<div class="form-group">
                            <label>Tytul Utworu</label>
							<select id ="id" name="id"  class="form-control"  >
							<?php 
							$sql1 = "SELECT id, tytul FROM utwory";
							if($result1 = mysqli_query($link, $sql1)){
								while($row1 = mysqli_fetch_array($result1)){
									echo '<option value= "'.$row1["id"] .'" >'.$row1["tytul"].'</option>';
									$id=$row1["id"];
									
								}
							}
									?>
							</select>
							</div>
					
							
						<input type="hidden" name="id_raport" value="<?php echo $id_raport; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Dodaj!">
                        <a href="raporty.php" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
           
</body>
</html>
