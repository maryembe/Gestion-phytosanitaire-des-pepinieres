<?php
session_start();
include "db_conn.php";
if (isset($_GET['N_enregistr'])) {
    $id_decl = $_GET['N_enregistr'];
    }


$host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "database";



    
    // Requête pour récupérer les informations de la déclaration

    
    $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM declaration WHERE N_enregistr = :id_decl";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_decl' => $id_decl]);
    $declaration = $stmt->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Details de la déclaration</title>
    <!-- stylesheets and other code -->
</head>
<body>
    <header>
        <!-- header content -->
    </header>
    <div class="container">
        <h2>Détails de la déclaration</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>ID de la déclaration</th>
                    <td><?php echo $declaration->N_enregistr; ?></td>
                </tr>
                <tr>
                    <th>État de conformité du contrôle documentaire</th>
                    <td><!-- Récupérer et afficher l'état de conformité du contrôle documentaire --></td>
                </tr>
                <tr>
                    <th>Contrôle 1</th>
                    <td><!-- Récupérer et afficher les informations du contrôle 1 --></td>
                </tr>
                <tr>
                    <th>Contrôle 2</th>
                    <td><!-- Récupérer et afficher les informations du contrôle 2 --></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
