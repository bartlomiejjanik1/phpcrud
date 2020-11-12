<?php

session_start();
	// Include config file
	require_once "connect.php";
//Connection to appdatabase
	$link = mysqli_connect($host, $db_user, $db_password, $db_name);
	$id="";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = $_POST['id'];
		$cars= $_POST['cars'];
		$muzyka = $_POST['muzyka'];
		echo $cars;
		echo $id;
		echo "<br>";
		echo $muzyka;
		
	} else { echo "Submit zasubmitowal.."; }


?>



<!DOCTYPE html>
<html lang="pl">
<head>
 </head>
<body>
    
                    <p>Wypełnij poniższyc formularz, aby dodać nowy Raport.</p>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
						<div class="form-group" >
						<input type="text" name="id" class="form-control" value="<?php echo $id; ?>">
						
						<label for="cars">Choose a car:</label>
						  <select id="cars" name="cars">
							<option value="volvo">Volvo</option>
							<option value="saab">Saab</option>
							<option value="fiat">Fiat</option>
							<option value="audi">Audi</option>
						  </select>
						</div>
						
								<select id ="muzyka" name="muzyka"  style="width:200px"  >
									<?php 
									$sql1 = "SELECT id, tytul FROM utwory";
									if($result1 = mysqli_query($link, $sql1)){
									while($row1 = mysqli_fetch_array($result1)){
										echo '<option value= "'.$row1["id"] .'" >'.$row1["tytul"].'</option>';
										//$id=$row1["id"];
										
										}
								}
									?>
								</select>
								
                    <input type="submit" class="btn btn-primary" value="Dodaj!">
					</form>
 </body>
</html>