<?php 

session_start();
include "db_conn.php";
$host = "localhost";
$user = "root";
$pass = "";
$dbname ="database";
 
if (isset($_GET['N_enregistr'])) {
    $_SESSION['N_enregistr'] = $_GET['N_enregistr'];
    $N_enregistr =  $_SESSION['N_enregistr'];
}if (isset($_GET['Etat'])) {
    $_SESSION['Etat'] = $_GET['Etat'];
    $N_enregistr =  $_SESSION['Etat'];
}
?>

<!DOCTYPE html>
<html>

<head>
    

    <title>Gestion phytosanitaire de la pépinière  </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="header.css" />
    <style>
	header {
    
    background-color: #012208d3;
    display: flex;
    align-items: center  ;
    justify-content: space-between ;
    padding: 1.2rem 5%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}




</style>

</head>

<body>
    <header>
        <img src="LOGO.png">


        <nav class="navbar">
        <a href="home.php">Mes déclarations </a>
           <a href="Controls.php?N_enregistr=<?php echo $_SESSION['N_enregistr'];?>&Etat=<?php echo $_SESSION['Etat']; ?>"> Formulaire  à remplir</a>
         
            
        </nav>
        </header>
     <!-- centrer le contenu horizontalement et verticalement sur la page. -->
	 <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<?php 
        try {
            $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch(PDOException $e) {
              echo "Échec de la connexion à la base de données : " . $e->getMessage();
        }
$stmt = $pdo->prepare('SELECT * FROM declaration WHERE N_enregistr = :N_enregistr');
$stmt->bindParam(':N_enregistr', $N_enregistr);
$N_enregistr =  $_SESSION['N_enregistr'];
$stmt->execute();

?>
      		
			
			  <table class="table">
    <thead>
            <th>Numero d'enregistrement</th>
            <th>Date de declaration </th>
            <th>Etat </th>
			
    
    </thead>

    <tbody>
    
    <?php      while($row = $stmt->fetch())
                {?>                <tr>
                                    <td><?php echo $row->N_enregistr;?></td>
                                    <td><?php echo $row->date_decl;?></td>
                                    <td><?php echo $row->Etat;?> </td>
                                                               
                                    
                                
                                        </tr>
                        <?php } ?>  
    </tbody>
    
    </table>



    </header>


   
    <script src="main.js">

    </script>
</body>

</html>
