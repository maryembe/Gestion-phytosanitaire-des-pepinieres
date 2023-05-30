<?php  

session_start();
include "../php/db_conn.php";

if (isset($_GET['id_ctrl1'])) {
    $_SESSION['id_ctrl1'] = $_GET['id_ctrl1'];
}
if (isset($_SESSION['id_ctrl1'])) {
    $id_ctrl1 = $_SESSION['id_ctrl1'];
    // Vérifier si le statut est déjà conforme
 /*   if (isset($_SESSION['conform']) && $_SESSION['conform'] == 'conforme') {
        // Rediriger l'utilisateur vers une autre page ou afficher un message
        header("Location: ../php/Control1.php?id_ctrl_doc=" . $_SESSION['id_ctrl_doc']);
        exit();
    }*/
//vérifier si les variables POST 'date_ctrl_doc', 'conform'  sont entres 
if ( isset($_POST['date_ctrl2']) && isset($_POST['conform'])) {
	/*definir la fonction test_input pour nettoyer les données saisies par l'utilisateur, supprimer
	les espaces en début et fin de chaîne, les antislashs et convertir les caractères spéciaux en entités HTML.*/
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$id_ctrl1 = test_input($id_ctrl1);
	$date_ctrl2 = test_input($_POST['date_ctrl2']);
	$conform = test_input($_POST['conform']);
/*vérifier si les champs 'date_ctrl_doc' et 'conform' ne sont pas vides. Si l'un des deux est vide,
 l'utilisateur est redirigé vers la page de Control avec un message d'erreur approprié.*/
	if (empty($date_ctrl2)) {
		header("Location: ../php/Control2.php?error=Date Control is Required&id_ctrl1=" . $_SESSION['id_ctrl1']);
	}else if (empty($conform)) {
		header("Location: ../php/Control2.php?error=Result is Required&id_ctrl1=" . $_SESSION['id_ctrl1']);
	}else {
// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "database";

        try {
            $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // $previousConform = getPreviousConformStatus($pdo, $id_decl);
       /* if ($previousConform === "nonConforme" && $conform === "conforme") {
              // Effectuer la mise à jour dans la base de données
              $updateSql = "UPDATE ctrl_doc SET date_ctrl_doc = :date_ctrl_doc ,conform = :conform WHERE id_decl = :id_decl";
              $updateStmt = $pdo->prepare($updateSql);
              $updateStmt->execute(['date_ctrl_doc' => $date_ctrl_doc,'conform' => $conform ,'id_decl' => $id_decl ]);
          }*/
            
            // Requête d'insertion des données dans la table
            
            $sql = "INSERT INTO ctrl2 (date_ctrl2, conform , id_ctrl1 ) VALUES (:date_ctrl2, :conform, :id_ctrl1)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['date_ctrl2' => $date_ctrl2, 'conform' => $conform , 'id_ctrl1' => $id_ctrl1]);
            // Recuperation de id_ctrl_doc
            $sql1 = "SELECT id_ctrl2 FROM ctrl2 WHERE id_ctrl1 = :id_ctrl1";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute(['id_ctrl1' => $id_ctrl1]);
            $row = $stmt1->fetch(PDO::FETCH_ASSOC);
           // $id_ctrl_doc = $row['id_ctrl_doc'];
            // Vérifier si le statut conform a été modifié de "nonConforme" à "conforme"
            
          /*  if ($conform === "conforme") {
                // Effectuer la mise à jour dans la base de données
                $updateSql = "UPDATE ctrl_doc SET date_ctrl_doc = :date_ctrl_doc ,conform = :conform WHERE id_decl = :id_decl";
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->execute(['date_ctrl_doc' => $date_ctrl_doc,'conform' => $conform ,'id_decl' => $id_decl ]);
                $_SESSION['conform']= $conform;
        }*/
            /*sélectionner les données de la table "users" où 
		le username et le password correspondent à ceux fournis par l'utilisateur.*/
        $id_ctrl1 = $_SESSION['id_ctrl1'];

$sql2 = "SELECT *
         FROM ctrl2
         WHERE id_ctrl1 = '$id_ctrl1'
         AND id_ctrl2 = (SELECT MAX(id_ctrl2) FROM ctrl2 WHERE id_ctrl1 = '$id_ctrl1')";

        $result2 = mysqli_query($conn, $sql2);

		
        	
			/*les données de l'utilisateur sont stockées dans des variables de session
			 et l'utilisateur est redirigé vers la page d'accueil ("../home.php").*/
        	$row2 = mysqli_fetch_assoc($result2);
        	
        		
        		
        		$_SESSION['conform'] = $row2['conform'];
        		$_SESSION['id_ctrl1'] = $row2['id_ctrl1'];
                $_SESSION['id_ctrl2'] = $row2['id_ctrl2'];

        		header("Location: ../php/Control3.php?id_ctrl2=" . $_SESSION['id_ctrl2']);
//sinon l'utilisateur est redirigé vers la page de connexion avec un message d'erreur approprié.
        	
        

              
    
            /*if ($conform === "conforme") {
                $hideForm = true;
                $showAnotherForm = true;
                
            }elseif ($conform === "nonConforme") {
                $needComplement = true;
            }*/
            
            
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de la connexion ou de l'insertion des données
            echo "Erreur : " . $e->getMessage();
        }
       
    
    
    
		
        
	
	
}}}else {header("Location: ../php/Control2.php?id_ctrl1=" . $_SESSION['id_ctrl1']);
	
}