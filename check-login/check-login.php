<?php  
session_start();
include "../php/db_conn.php";
//vérifier si les variables POST 'username', 'password' et 'role' sont entres 
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
	/*definir la fonction test_input pour nettoyer les données saisies par l'utilisateur, supprimer
	les espaces en début et fin de chaîne, les antislashs et convertir les caractères spéciaux en entités HTML.*/
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$role = test_input($_POST['role']);
/*vérifier si les champs 'username' et 'password' ne sont pas vides. Si l'un des deux est vide,
 l'utilisateur est redirigé vers la page de connexion avec un message d'erreur approprié.*/
	if (empty($username)) {
		header("Location: ../php/login.php?error=User Name is Required");
	}else if (empty($password)) {
		header("Location: ../php/login.php?error=Password is Required");
	}else {

		// hasher password en utilisant la fonction "md5"
		$password = md5($password);
        /*sélectionner les données de la table "users" où 
		le username et le password correspondent à ceux fournis par l'utilisateur.*/
        $sql = "SELECT * FROM pep WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

		// Si une seule ligne correspondante est trouvée(par unicite de username), 
        if (mysqli_num_rows($result) === 1) {
        	
			/*les données de l'utilisateur sont stockées dans des variables de session
			 et l'utilisateur est redirigé vers la page d'accueil ("../home.php").*/
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password && $row['role'] == $role) {
        		
        		
        		$_SESSION['role'] = $row['role'];
        		$_SESSION['username'] = $row['username'];

        		header("Location: ../php/home.php");
//sinon l'utilisateur est redirigé vers la page de connexion avec un message d'erreur approprié.
        	}else {
        		header("Location: ../php/login.php?error=Incorect User name or password");
        	}
        }else {
        	header("Location: ../php/login.php?error=Incorect User name or password");
        }

	}
	
}else {
	header("Location: ../php/login.php");
}