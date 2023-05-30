<?php 

   session_start();
   if (isset($_GET['id_decl'])) {
    $_SESSION['id_decl'] = $_GET['id_decl'];
}
   if ($_SESSION['Etat']=="Control documentaire non conforme "   )  {   ?>
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

    </header>
	
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      <form class="border shadow p-3 rounded"
    action="../check/check_Control_doc.php?id_decl=<?php echo $_SESSION['N_enregistr']; ?>" 
          method="post" 
          style="width: 450px;background-color: #ffffff;">
          <h1 class="text-center p-3">Ajout de complement de dossier  :</h1>
          <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
            <?=$_GET['error']?>
        </div>
        <?php } ?>
       
    <div class="mb-3">
      <label for="date_ctrl_doc" 
             class="form-label">Date d'ajout:</label>
      <input type="Date" 
             class="form-control" 
             name="date_ctrl_doc" 
             id="date_ctrl_doc">
    </div>
    <div class="mb-3">
   
              <label for="Resultat du contrôle">Resultat :</label>
         
<select  name="conform" id="conform" required><br><br>
       <option value="conforme">Conforme</option>
       <option value="nonConforme">Necessite  un autre complément de dossier</option>
</select>
    </div>
    
   
    <button type="submit" 
            class="btn btn-primary">Enregistrer</button>
  </form>
      </div>
</body>
</html>
<?php }else{
	header("Location: Control_doc_non_conforme.php?id_decl=" . $_SESSION['id_decl']);
} ?>