<?php
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
// Usuwamy po zatwierdzeniu formularza
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Dołacznie pliku config
    require_once "connect.php";
    $link = mysqli_connect($host, $db_user, $db_password, $db_name);
    // Delete statement
    $sql = "DELETE FROM utwory WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Dołączenie zmiennych jako parametrów do prepared statements
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Przypisanie parametrów
        $param_id = trim($_POST["id"]);
        
        // Wykonanie prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Usuwanie powidoło sie, przekirowanie 
            header("location: utwory.php");
            exit();
        } else{
            echo "Oops! Cos poszlo nie tak!";
        }
    }
     
    // Zamykamy statement
    mysqli_stmt_close($stmt);
    
    // Koniec połączenia
    mysqli_close($link);
} else{
    // Sprawdzam czy id istnieje
    if(empty(trim($_GET["id"]))){
        // URL nie zawiera id, przekiruj na Error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>Usuń Rekord</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Czy napewno chcesz usunąć wybrany utwór?</p><br>
                            <p>
                                <input type="submit" value="Tak" class="btn btn-danger">
                                <a href="utwory.php" class="btn btn-default">Nie</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>