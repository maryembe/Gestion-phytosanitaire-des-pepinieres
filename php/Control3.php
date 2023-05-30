<?php 

   session_start();
   include "db_conn.php";
   $host = "localhost";
$user = "root";
$pass = "";
$dbname ="database";
   if (isset($_SESSION['id_ctrl2'])) {   
   ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ctrl1</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
<a href="index.php"> <img src="LOGO.png" alt="logo"></a>



    
    



    </header>
     <!-- centrer le contenu horizontalement et verticalement sur la page. -->
	 <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
	  <!-- vérifier le rôle de l'utilisateur et afficher les contenus en fonction du rôle . -->
      	<?php 
			// s'il s'agit d'un agent de controle 
			try {
    $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch(PDOException $e) {
    echo "Échec de la connexion à la base de données : " . $e->getMessage();
}if ($_SESSION['conform'] == 'conforme') { ?>
      <h1 class="text-center p-3">fin :</h1>
      <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-danger" role="alert">
        <?=$_GET['error']?>
    </div>
    <?php  }?>
   




</form> <?php }elseif($_SESSION['conform'] == 'nonConforme') {?>
    <form class="border shadow p-3 rounded"
    action="../check/check_Control2.php?id_ctrl1=<?php echo $_SESSION['id_ctrl1']; ?>" 
          method="post" 
          style="width: 450px;background-color: #ffffff;">
          <h1 class="text-center p-3">Ajout de complement de dossier  :</h1>
          <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
            <?=$_GET['error']?>
        </div>
        <?php } ?>
       
    <div class="mb-3">
      <label for="date_ctrl2" 
             class="form-label">Date d'ajout:</label>
      <input type="Date" 
             class="form-control" 
             name="date_ctrl2" 
             id="date_ctrl2">
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
          
      		
      	<?php } ?>
      </div>
</body>
</html>
<?php }else{
	header("Location: home.php");
} ?>