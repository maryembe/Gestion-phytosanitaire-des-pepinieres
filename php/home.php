<?php 

    session_start();
    include "db_conn.php";
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname ="database";
    if (isset($_SESSION['username'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style>
	header {
    
    background-color: #012208d3;
    display: flex;
    align-items: center  ;
    justify-content: space-between ;
    padding: 0.3rem 5%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}

img[alt="logo"]{
	width: 120px;
    padding-top:0px;
    padding-bottom: 0px;
}
.corps{
    margin-top: 80px;
}
</style>


</head>
<body>
<header>
<a href="index.php"> <img src="../img/logo.png" alt="logo"></a>


    </header>
     <!-- centrer le contenu horizontalement et verticalement sur la page. -->
	 <div class="container d-flex justify-content-center align-items-center corps"
      style="min-height: 100vh">
	  <!-- vérifier le rôle de l'utilisateur et afficher les contenus en fonction du rôle . -->
      	<?php if ($_SESSION['role'] == 'Agent') {
			// s'il s'agit d'un agent de controle 
			try {
                $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
                 $pdo = new PDO($dsn, $user, $pass);
                 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch(PDOException $e) {
                 echo "Échec de la connexion à la base de données : " . $e->getMessage();
            }
    $stmt = $pdo->query('SELECT * FROM declaration');?>
      		
			
	<table class="table">
    <thead>
            <th>Numero d'enregistrement</th>
            <th>Date de declaration </th>
            <th>Etat </th>

    </thead>

    <tbody>
    
    <?php      while($row = $stmt->fetch())
                { ?>                <tr>
                                    <td><?php echo $row->N_enregistr;?></td>
                                    <td><?php echo $row->date_decl;?></td>
                                    <td><?php echo $row->Etat;?> </td>
                                                               
                                        <td>
                                        
 <a href="Menu.php?N_enregistr=<?php echo $row->N_enregistr;?>&Etat=<?php echo $row->Etat; ?>"><button class="btn btn-primary" >Choisir<i class="far fa-edit"></i> </button></a>
                             
                                           
                                   
                                        </td>
                                
                                        </tr>
                        <?php } ?>  
    </tbody>
    
    </table>
      		<div class="card" style="width: 18rem;">
			  <img src="../img/admin-default.png" 
			       class="card-img-top" 
			       alt="Agent image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['username']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
			
      	<?php }else {
         
          header("Location: ../projet pépinière/client_page.php");
      		
      		
      	 } ?>
      </div>
</body>
</html>
<?php }else{
	header("Location: login.php");
} ?>