<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
     <!-- centrer le contenu horizontalement et verticalement sur la page. -->
	 <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
	  <!-- vérifier le rôle de l'utilisateur et afficher les contenus en fonction du rôle . -->
      	<?php if ($_SESSION['role'] == 'Agent') {?>
      		<!-- s'il s'agit d'un agent de controle -->
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
			
      	<?php }else { ?>
      		<!-- s'il s'agit d'un pepinieriste -->
      		<div class="card" style="width: 18rem;">
			  <img src="../img/user-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['username']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
      	<?php } ?>
      </div>
</body>
</html>
<?php }else{
	header("Location: login.php");
} ?>