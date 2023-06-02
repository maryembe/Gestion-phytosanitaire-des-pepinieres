<?php
session_start();
?>



<?php

if(isset($_POST["submit"])){
    include "connection.php";

    $user=$_SESSION["username"];


    $req=$conn->prepare("INSERT INTO `declaration` (id_pep) VALUES ( :user);");
    $req->bindParam(":user",$user);
    $req->execute();

    $list_decl= $conn->prepare("SELECT * FROM `declaration` WHERE `id_pep` = :user");
    $list_decl->bindParam(":user", $user);
    $list_decl->execute();
    $list = $list_decl->fetchAll();

    $decl_id_current=$list[count($list)-1]['N_enregistr'];
    

    $n=(count($_POST)-2)/4;
    

    if(count($list)==1){
        //inserer tous les plants
        for($i=0;$i<$n;$i++){
            $es="espece" . $i;
            $var="var" . $i;
            $por_g="p_g" . $i;
            $nb="nb_p" . $i;

            $req_inser_new=$conn->prepare("INSERT INTO `plant` (espece,variete,porte_greffe,nb,id_decl) VALUES ( :es, :var, :por_g,:nb,:id_decl);");
            $req_inser_new->bindParam(":es", $_POST[$es]);
            $req_inser_new->bindParam(":var", $_POST[$var]);
            $req_inser_new->bindParam(":por_g", $_POST[$por_g]);
            $req_inser_new->bindParam(":nb", $_POST[$nb]);
            $req_inser_new->bindParam(":id_decl", $decl_id_current);
            $req_inser_new->execute();
        }
        echo "hello";
        echo "c'est" . var_dump($_POST[$es]);

    }else{
        $decl_id_past=$list[count($list)-2]['N_enregistr'];
        /*     tentative pour ne comprer que des declarations d'années succéssives
        $date_cur=$list[count($list)-1]['date_decl'];
        $date = $list[count($list)-2]['date_decl'];

        $annee_cur = date('Y', strtotime($date_cur));
        $annee = date('Y', strtotime($date))-1;
        if($annee!=$annee_cur){
        }*/

        //importer les anciennes plantes
        $import_past= $conn->prepare("SELECT * FROM `plant` WHERE `id_decl` = :id_past");
        $import_past->bindParam(":id_past", $decl_id_past);
        $import_past->execute();
        $list_plant = $import_past->fetchAll();


        //inclure toutes les plantes anciennes concernées dans la nouvelle declaration
        $req_update_id= $conn->prepare("UPDATE plant SET id_decl = :id_cur WHERE id_decl = :id_past;");
        $req_update_id->bindParam(":id_cur", $decl_id_current);
        $req_update_id->bindParam(":id_past", $decl_id_past);
        $req_update_id->execute();

        //inclure les nouvelles plantes

        for($i=0;$i<$n;$i++){

            $es="espece" . $i;
            $var="var" . $i;
            $por_g="p_g" . $i;
            $nb="nb_p" . $i;

            $inserted=false;
            foreach($list_plant as $plant){
                if($_POST[$es]== $plant["espece"] && $_POST[$var]== $plant["variete"] && $_POST[$por_g]== $plant["porte_greffe"]){
                    //il s'agit d'une plante de type déjà existant 
                    $stock=$_POST[$nb]+$plant["nb"];

                    $req_update_stock= $conn->prepare("UPDATE plant SET nb = :nb WHERE id_decl = :id_cur;");
                    $req_update_stock->bindParam(":id_cur", $decl_id_current);
                    $req_update_stock->bindParam(":nb", $stock);
                    $req_update_stock->execute();
                    $inserted=true;
                    break;
                }
            }
            if($inserted==false){
                $req_insert=$conn->prepare("INSERT INTO `plant` (espece,variete,porte_greffe,nb,id_decl) VALUES ( :es, :var, :por_g,:nb,:id_decl);");
                $req_insert->bindParam(":es", $_POST[$es]);
                $req_insert->bindParam(":var", $_POST[$var]);
                $req_insert->bindParam(":por_g", $_POST[$por_g]);
                $req_insert->bindParam(":nb", $_POST[$nb]);
                $req_insert->bindParam(":id_decl", $decl_id_current);
                $req_insert->execute();
            }
        }

        
    }
    header("Location: client_page.php?decl=done");
}

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="inscription.css">
    <style>
        header{
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
        }
    </style>
    <title>Nouvelle déclaration</title>
    
</head>
<body>
    <header> 
        <a href="../php/index.php"><img src="../img/logo.png" alt="logo"width=120px></a> 
        <a href="#" class="btn btn-danger btn-lg">
            <span class="glyphicon glyphicon-off"></span> Sign Out
        </a>
    </header>
    <div class="container">
        <h1>Nouvelle Déclaration</h1>
        <form action="new_decl.php" method="post">
            <div class="form-group">
                <input class="form-control" type="number" name="nb_v" placeholder="Nombre de total variétés à déclarer">
            </div>
            <div class="corps"></div>
            <button class="btn btn-success" type="submit" name="submit">Déclarer</button>
        </form>
    </div> 
    <script src="new_decl.js"></script>
</body>
</html>