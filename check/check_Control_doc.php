<?php  
session_start();
include "../php/db_conn.php";

if (isset($_GET['id_decl'])) {
    $_SESSION['id_decl'] = $_GET['id_decl'];
   
}
if (isset($_SESSION['id_decl'])) {
    $id_decl = $_SESSION['id_decl'];}
    
//vérifier si les variables POST 'date_ctrl_doc', 'conform'  sont entres 
if ( isset($_POST['date_ctrl_doc']) && isset($_POST['conform'])) {
	/*definir la fonction test_input pour nettoyer les données saisies par l'utilisateur, supprimer
	les espaces en début et fin de chaîne, les antislashs et convertir les caractères spéciaux en entités HTML.*/
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$id_decl = test_input($id_decl);
	$date_ctrl_doc = test_input($_POST['date_ctrl_doc']);
	$conform = test_input($_POST['conform']);
/*vérifier si les champs 'date_ctrl_doc' et 'conform' ne sont pas vides. Si l'un des deux est vide,
 l'utilisateur est redirigé vers la page de Control avec un message d'erreur approprié.*/
 
	if (empty($date_ctrl_doc)) {
        
		header("Location: ../php/Controls.php?error=Date Control is Required&id_decl=" . $_SESSION['id_decl']);
        
	}else if (empty($conform)) {
		
            header("Location: ../php/Controls.php?error=Result is Required&id_decl=" . $_SESSION['id_decl']);
         
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
            
            // Requête d'insertion des données dans la table ctrl_doc
            $sql = "INSERT INTO ctrl_doc (date_ctrl_doc, conform , id_decl ) VALUES (:date_ctrl_doc, :conform, :id_decl)ON DUPLICATE KEY UPDATE
            date_ctrl_doc = :date_ctrl_doc, conform = :conform";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['date_ctrl_doc' => $date_ctrl_doc, 'conform' => $conform , 'id_decl' => $id_decl ]);

           
            
            


            // Recuperation de id_ctrl_doc
            //$sql1 = "SELECT * FROM ctrl_doc WHERE id_decl = :id_decl";
            $sql1 = "SELECT * FROM ctrl_doc WHERE id_ctrl_doc = (SELECT MAX(id_ctrl_doc) FROM ctrl_doc WHERE id_decl = :id_decl)";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute(['id_decl' => $id_decl]);
            $row = $stmt1->fetch(PDO::FETCH_ASSOC);
            $id_ctrl_doc = $row['id_ctrl_doc'];
            $conform = $row['conform'];
            $Result_ctrl_doc = $row['conform'];


            $N_enregistr=$id_decl;

 // Requête d'insertion des données dans la table courrier
            $sql100 = "INSERT INTO courrier (id_ctrl_doc, Result_ctrl_doc  ) VALUES (:id_ctrl_doc ,:Result_ctrl_doc)ON DUPLICATE KEY UPDATE
            id_ctrl_doc = :id_ctrl_doc, Result_ctrl_doc = :Result_ctrl_doc";
            $stmt100 = $pdo->prepare($sql100);
            $stmt100->execute(['id_ctrl_doc' => $id_ctrl_doc, 'Result_ctrl_doc' => $Result_ctrl_doc  ]);


            if ($conform === "conforme") {
                // Effectuer la mise à jour dans la base de données
            
            $Etat="Control documentaire conforme";
           /* $updateSql3 = "UPDATE declaration SET Etat = :Etat  WHERE N_enregistr = :N_enregistr";
            $updateStmt3 = $pdo->prepare($updateSql3);
            $updateStmt3->execute(['Etat' => $Etat ,'N_enregistr' => $N_enregistr ]);
    
            $_SESSION['Etat']= $Etat;*/
        }
        elseif ($conform === "nonConforme") {
            // Effectuer la mise à jour dans la base de données
            $Etat="Control documentaire non conforme";
           /* $updateSql4 = "UPDATE declaration SET Etat = :Etat  WHERE N_enregistr = :N_enregistr";
            $updateStmt4 = $pdo->prepare($updateSql4);
            $updateStmt4->execute(['Etat' => $Etat ,'N_enregistr' => $N_enregistr ]);
    
            $_SESSION['Etat']= $Etat;*/

    }

    $updateSql3 = "UPDATE declaration SET Etat = :Etat  WHERE N_enregistr = :N_enregistr";
            $updateStmt3 = $pdo->prepare($updateSql3);
            $updateStmt3->execute(['Etat' => $Etat ,'N_enregistr' => $N_enregistr ]);
    
            $_SESSION['Etat']= $Etat;
          /*  if ($conform === "conforme") {
                // Effectuer la mise à jour dans la base de données
                $updateSql = "UPDATE ctrl_doc SET date_ctrl_doc = :date_ctrl_doc ,conform = :conform WHERE id_decl = :id_decl";
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->execute(['date_ctrl_doc' => $date_ctrl_doc,'conform' => $conform ,'id_decl' => $id_decl ]);
                $_SESSION['conform']= $conform;
        }*/
            /*sélectionner les données de la table "users" où 
		le username et le password correspondent à ceux fournis par l'utilisateur.*/
        $id_decl = $_SESSION['id_decl'];

$sql2 = "SELECT *
         FROM ctrl_doc
         WHERE id_decl = '$id_decl'
         AND id_ctrl_doc = (SELECT MAX(id_ctrl_doc) FROM ctrl_doc WHERE id_decl = '$id_decl')";

        $result2 = mysqli_query($conn, $sql2);

		
        	
			/*les données de l'utilisateur sont stockées dans des variables de session
			 et l'utilisateur est redirigé vers la page d'accueil ("../home.php").*/
        	$row2 = mysqli_fetch_assoc($result2);
        	
        		
        		
        		//$_SESSION['conform'] = $row2['conform'];
        		$_SESSION['id_decl'] = $row2['id_decl'];
                $_SESSION['id_ctrl_doc'] = $row2['id_ctrl_doc'];

        		header("Location: ../php/Controls.php?id_ctrl_doc=" . $_SESSION['id_ctrl_doc']. "&Etat=" . $_SESSION['Etat']. "&N_enregistr=" . $_SESSION['N_enregistr']);

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
       
    
    
    
		
        
	
	
}}else {header("Location: ../php/Controls.php?id_decl=" . $_SESSION['id_decl']. "&Etat=" . $_SESSION['Etat']);
	
}