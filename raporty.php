<?php
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl"> 
<head>
    <meta charset="UTF-8">
    <title>Raporty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
    <link href="includes/welcome.css" rel="stylesheet">
	
	<style type="text/css">
        .wrapper{
            width: 1100px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>

	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">System Raportowania</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        
        <a class="p-2 text-dark" href="welcome.php">Strona Główna</a>
      </nav>
      <a class="btn btn-outline-primary" href="logout.php">Wyloguj się</a>
    </div>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Lista Raportów</h2>
                        <a href="createRaport.php" class="btn btn-success pull-right">Dodaj Raport</a>
                    </div>
                    <?php
                    // Dołacznie pliku config
                    require_once "connect.php";
					$link = mysqli_connect($host, $db_user, $db_password, $db_name);
                    
                    // Wykonanie zapytania do bazy
                    $sql = "SELECT * FROM (raporty LEFT JOIN utwory USING(id))";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>L.P</th>";
                                        echo "<th>Nazwa</th>";
                                        //echo "<th>id</th>";
                                        echo "<th>Tytul</th>";
                                        echo "<th>Liczba Emisji</th>";
										echo "<th>Akcja</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_raport'] . "</td>";
                                        echo "<td>" . $row['nazwa_raport'] . "</td>";
                                        //echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['tytul'] . "</td>";
                                        echo "<td>" . $row['liczbaEmisji'] . "</td>";

                                        echo "<td>";
									        echo "<a href='readRaport.php?id=". $row['id_raport'] ."' title='Zobacz Raport' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='updateRaport.php?id_raport=". $row['id_raport'] ."' title='Edytuj Raport' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deleteRaport.php?id=". $row['id_raport'] ."' title='Usuń Raport' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Czyscimy zmienna result
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Nie znaleziono rekordów w bazie.</em></p>";
                        }
                    } else{
                        echo "ERROR: zapytanie sql sie nei wykonalo!. " . mysqli_error($link);
                    }
 
                    // Koniec połączenia
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
		
		
		
    </div>
	
</body>
</html>