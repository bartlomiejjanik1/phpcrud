<?php

	session_start();
	// Include config file
	require_once "connect.php";
	$link = mysqli_connect($host, $db_user, $db_password, $db_name);
	$pass ="";
 
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
        echo $_GET['id_raport'];
		$pass = $_GET['id_raport'];
		echo $pass;
		} else {
		 
			if(isset($_GET['id_raport'])) {
		
				$id_piosenki=$_POST['id'];
				echo $_GET['id_raport'];
				
				$sql = "UPDATE raporty SET id=? WHERE id_raport= '.$pass.'";
				
				if($stmt = mysqli_prepare($link, $sql)){
					// Bind variables to the prepared statement as parameters
				   mysqli_stmt_bind_param($stmt, "i", $param_id_piosenki);
				  
					
					$param_id_piosenki = $id_piosenki;
					
					if(mysqli_stmt_execute($stmt)){
						// Records created successfully. Redirect to landing page
						
						echo "dziala";
						exit();
						} else{
							echo "Something went wrong. Please try again later.";
						}
					} echo "Link nie poszedl";
		
				} echo "Submit nie zasubmitowal..";
			} 


?>


<!DOCTYPE html>
<html lang="pl">
<head>
 </head>
<body>
    
                    <p>A teraz z otryzmanego ID wrzucmy do INSERTA</p>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
						<div class="form-group" >
                            <label>Numer id Piosenki do dodania do raortu</label>
                            <input type="number" name="id" class="form-control" value="">
                            
                        </div>
                       
												
										
                        <input type="submit" class="btn btn-primary" value="Dodaj id do raporty!">
                        <a href="utwory.php" class="btn btn-default">Anuluj</a>
                    </form>
                
 </body>
</html>