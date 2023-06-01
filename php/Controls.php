<?php 

   session_start();
   if (isset($_GET['id_ctrl_doc'])) {
    $_SESSION['id_ctrl_doc'] = $_GET['id_ctrl_doc'];
}
if (isset($_GET['Etat'])) {
    $_SESSION['Etat'] = $_GET['Etat'];
}?>
<!DOCTYPE html>
<html>


<head>
	<title> ..</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="header.css" />
	<link rel="stylesheet" href="controls.css" />
	<style>
		body {
			background-image: url(3.jpg);
            background-repeat: no-repeat;
            background-size: 1350px 700px;
			background-color: #012208d3;
		}
		.btn.btn-primary  {
  width: 100%;
  padding: 10px;
  background-color: #054207;
  color: #fff;
  font-weight: bold;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn.btn-primary :hover {
  background-color: #052506;
}
.FIN {
	
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: #fff;
  font-size: 24px;


}
		
	</style>

</head>
<body>
<header>
<a href="index.php"> <img src="LOGO.png" alt="logo"></a>
<nav class="navbar">
        <a href="home.php">Mes déclarations </a>
           
            
        </nav>
    </header>
	<div class="Controls  ">
	<?php   if ($_SESSION['Etat']=="Non prise en charge"   )  {   ?>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
          action="../check/check_Control_doc.php?id_decl=<?php echo $_SESSION['N_enregistr']; ?>" 
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle documentaire :</h1>
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
             <option value="nonConforme">Necessite  un complément de dossier</option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>
<?php

 } elseif 
	 ($_SESSION['Etat']=="Control documentaire non conforme"   )  {?>
<div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
          action="../check/check_Control_doc.php?id_decl=<?php echo $_SESSION['N_enregistr']; ?>" 
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle documentaire non conforme:</h1>
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
         
                    <label for="Resultat du contrôle">Resultat d'ajout de complement:</label>
               
    <select  name="conform" id="conform" required><br><br>
             <option value="conforme">Conforme</option>
             <option value="nonConforme">Necessite  un complément de dossier</option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>

	 <?php } elseif 
	 ($_SESSION['Etat']=="Control documentaire conforme"   )  {?>
<div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
		  action="../check/check_control1.php?id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc']; ?>&N_enregistr=<?php echo $_SESSION['N_enregistr']; ?>&Etat=<?php echo $_SESSION['Etat']; ?>"
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle physique 1:</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
             
		  <div class="mb-3">
		    <label for="date_ctrl1" 
		           class="form-label">Date de contrôle:</label>
		    <input type="Date" 
		           class="form-control" 
		           name="date_ctrl1" 
		           id="date_ctrl1">
		  </div>
		  <div class="mb-3">
         
                    <label for="Resultat du contrôle">Resultat de contrôle:</label>
               
    <select  name="conform" id="conform" required><br><br>
             <option value="conforme">Conforme</option>
             <option value="nonConforme">Non conforme</option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>

	 <?php } elseif 
	 ($_SESSION['Etat']=="Control Physique 1 non conforme"   )  {?>
<div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
		  action="../check/check_control1.php?id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc']; ?>&N_enregistr=<?php echo $_SESSION['N_enregistr']; ?>&Etat=<?php echo $_SESSION['Etat']; ?>" 
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle physique 1 non conforme :</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
             
		  <div class="mb-3">
		    <label for="date_ctrl1" 
		           class="form-label">Date de contrôle:</label>
		    <input type="Date" 
		           class="form-control" 
		           name="date_ctrl1" 
		           id="date_ctrl1">
		  </div>
		  <div class="mb-3">
         
                    <label for="Resultat du contrôle">Resultat de contrôle:</label>
               
    <select  name="conform" id="conform" required><br><br>
             <option value="conforme">Conforme</option>
             <option value="nonConforme">Non conforme</option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>

	 <?php } elseif 
	 ($_SESSION['Etat']=="Control Physique 1 conforme"   )  {?>
<div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
		  action="../check/check_control2.php?id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc']; ?>&N_enregistr=<?php echo $_SESSION['N_enregistr']; ?>&Etat=<?php echo $_SESSION['Etat']; ?>&id_ctrl1=<?php echo $_SESSION['id_ctrl1']; ?>"
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle physique 2:</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
             
		  <div class="mb-3">
		    <label for="date_ctrl2" 
		           class="form-label">Date de contrôle:</label>
		    <input type="Date" 
		           class="form-control" 
		           name="date_ctrl2" 
		           id="date_ctrl2">
		  </div>
		  <div class="mb-3">
         
                    <label for="Resultat du contrôle">Resultat de contrôle:</label>
               
    <select  name="conform" id="conform" required><br><br>
             <option value="conforme">Conforme</option>
             <option value="nonConforme">Non conforme</option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>

	 <?php } elseif 
	 ($_SESSION['Etat']=="Control Physique 2 non conforme"   )  {?>
<div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
		  action="../check/check_control2.php?id_ctrl_doc=<?php echo $_SESSION['id_ctrl_doc']; ?>&N_enregistr=<?php echo $_SESSION['N_enregistr']; ?>&Etat=<?php echo $_SESSION['Etat']; ?>&id_ctrl1=<?php echo $_SESSION['id_ctrl1']; ?>" 
      	      method="post" 
      	      style="width: 450px;background-color: #ffffff;">
      	      <h1 class="text-center p-3">Contrôle physique 2 non conforme :</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
             
		  <div class="mb-3">
		    <label for="date_ctrl2" 
		           class="form-label">Date de contrôle:</label>
		    <input type="Date" 
		           class="form-control" 
		           name="date_ctrl2" 
		           id="date_ctrl2">
		  </div>
		  <div class="mb-3">
         
                    <label for="Resultat du contrôle">Resultat de contrôle:</label>
               
    <select  name="conform" id="conform" required><br><br>
             <option value="conforme">Conforme</option>
             <option value="nonConforme">Non conforme</option>
    </select>
		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-primary">Enregistrer</button>
		</form>
      </div>

	 <?php } 
	 else{ ?>
	 <div class="FIN">
    <h1>Tout est conforme !</h1>
	 </div>
<?php } ?>
</div>
</body>
	 
</html>
