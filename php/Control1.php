<?php 

   session_start();
   if (isset($_GET['id_ctrl_doc'])) {
    $_SESSION['id_ctrl_doc'] = $_GET['id_ctrl_doc'];
}if (isset($_GET['id_ctrl_1'])) {
    $_SESSION['id_ctrl_1'] = $_GET['id_ctrl_1'];}
if (isset($_GET['Etat'])) {
    $_SESSION['Etat'] = $_GET['Etat'];
}?>
<!DOCTYPE html>
<html>


<head>
	<title> ..</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="header.css" />
	<style>
		body {
			background-image: url(3.jpg);
            background-repeat: no-repeat;
            background-size: 1350px 700px;
			background-color: #012208d3;
		}
		
	</style>

</head>
<body>
<header>
<a href="index.php"> <img src="LOGO.png" alt="logo"></a>
<nav class="navbar">
        <a href="home.php">Liste des declarations </a>
            <a href="Controls.php?N_enregistr=<?php echo $_SESSION['N_enregistr'];?>&Etat=<?php echo $_SESSION['Etat']; ?>">Controle documentaire</a>
            <a href="Control1.php?id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc'];?>&N_enregistr=<?php echo $_SESSION['N_enregistr']; ?>&Etat=<?php echo $_SESSION['Etat']; ?>">Controle physique 1</a>
            <a href="Control2.php?N_enregistr=<?php echo $_SESSION['N_enregistr'];?>&id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc'];?>&N_enregistr=<?php echo $_SESSION['N_enregistr'];?>&Etat=<?php echo $_SESSION['Etat']; ?>">Contrôle physique 2</a>
            
        </nav>

    </header>
	<?php   if ($_SESSION['Etat']=="Control documentaire conforme"   )  {   ?>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
          action="../check/check_control1.php?id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc']; ?>&N_enregistr=<?php echo $_SESSION['N_enregistr']; ?>&Etat=<?php echo $_SESSION['Etat']; ?>" 
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle physique1 :</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
             
		  <div class="mb-3">
		    <label for="date_ctrl_doc" 
		           class="form-label">Date de contrôle:</label>
		    <input type="Date" 
		           class="form-control" 
		           name="date_ctrl_doc" 
		           id="date_ctrl_doc">
		  </div>
		  <div class="mb-3">
         
                    <label for="Resultat du contrôle">Resultat du contrôle:</label>
               
    <select  name="conform" id="conform" required><br><br>
             <option value="conforme">Conforme</option>
             <option value="nonConforme">Non conforme</option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>
<?php

 } elseif 
	 ($_SESSION['Etat']=="Control Physique 1 non conforme"   )  {?>
<div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
          action="../check/check_control1.php?id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc']; ?>&N_enregistr=<?php echo $_SESSION['N_enregistr']; ?>&Etat=<?php echo $_SESSION['Etat']; ?>" 
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle physique 1 non conforme:</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
             
		  <div class="mb-3">
		    <label for="date_ctrl_doc" 
		           class="form-label">Date de contrôle:</label>
		    <input type="Date" 
		           class="form-control" 
		           name="date_ctrl_doc" 
		           id="date_ctrl_doc">
		  </div>
		  <div class="mb-3">
         
                    <label for="Resultat du contrôle">Resultat du nouveau controle':</label>
               
    <select  name="conform" id="conform" required><br><br>
             <option value="conforme">Conforme</option>
             <option value="nonConforme">non conforme </option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>

	 <?php } 
	 else{ ?>
    <h1>Control physique 1 conforme </h1>
<?php } ?>
</body>
	 
</html>
