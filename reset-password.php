<?php
// Inicializacja sesji
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php"; //to samo co include
	$link = mysqli_connect($host, $db_user, $db_password, $db_name);
	
// Definicja zmiennych z pustymi wartosciami
	$new_password = $confirm_password = "";
	$new_password_err = $confirm_password_err = "";
 
// Procesowanie formularza, gdy uzytkownik kliknie Zatwierdź 
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
		// Walidacja nowego hasła
		if(empty(trim($_POST["new_password"]))){
			$new_password_err = "Wpisz nowe haslo!";     
		} elseif(strlen(trim($_POST["new_password"])) < 6){
			$new_password_err = "Haslo musi miec minimum 6 znaków!";
		} else{
			$new_password = trim($_POST["new_password"]);
		}
		
		// Walidacja pola potwierdzenia hasła
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Potwierdź hasło!";
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($new_password_err) && ($new_password != $confirm_password)){
				$confirm_password_err = "Wpisane hasła nie są takie same!";
			}
		}
			
		// Sprawdzam czy są błędy zanim Update sie wykona
		if(empty($new_password_err) && empty($confirm_password_err)){
			// Update statement
			$sql = "UPDATE users SET password = ? WHERE id = ?";
			
			if($stmt = mysqli_prepare($link, $sql)){
				// Dopisanie zmiennych do prepared statement jako parametry
				mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
				
				// Przypisanie parametrów, w tym hash z wpisanego hasła
				$param_password = password_hash($new_password, PASSWORD_DEFAULT);
				$param_id = $_SESSION["id"];
				
				// Wykonanie prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Jesli hasło zmienione to destroy session i przekiruj na index.php
					session_destroy();
					header("location: index.php");
					exit();
				} else{
					echo "Cos poszlo nie tak.";
				}

				// zamykam statement
				mysqli_stmt_close($stmt);
			}
		}
		
		// Koniec connection z baza danych
		mysqli_close($link);
	}
?>
 
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ padding: 20px; width: 30%;
		margin: 0 auto;
		position: relative;
		max-width: 1024px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Resetuj hasło!</h2>
        <p>Wypełnij poniższy formularz aby zmienić swoje hasło</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Nowe Hasło</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Potwierdź nowe hasło</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Zatwierdź">
                <a class="btn btn-link" href="welcome.php">Anuluj</a>
            </div>
        </form>
    </div>    
</body>
</html>