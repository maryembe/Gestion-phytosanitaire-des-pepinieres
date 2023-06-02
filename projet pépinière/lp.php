<?php
session_start();
?>


<?php

if(isset($_POST["submit"])){
    
    include "connection.php";

    $user=$_SESSION["username"];
    
    $list_decl= $conn->prepare("SELECT N_enregistr FROM `declaration` WHERE `id_pep` = :user");
    $list_decl->bindParam(":user", $user);
    $list_decl->execute();
    $list_d = $list_decl->fetchAll();

    
    $decl_id=$list_d[count($list_d)-1];
    $decl_id=$decl_id[0];

    //enregistrer la demande du acp
    $dest=$_POST["dest"];
    $save_acp=$conn->prepare("INSERT INTO `acp` (destination,id_DECL) VALUES ( :destin,:id);");
    $save_acp->bindParam(":destin",$dest);
    $save_acp->bindParam(":id",$decl_id);
    $save_acp->execute();

    $list_plant= $conn->prepare("SELECT * FROM `plant` WHERE `id_decl` = :id");
    $list_plant->bindParam(":id", $decl_id);
    $list_plant->execute();
    $list_p = $list_plant->fetchAll();

    $n=(count($_POST)-3)/4;
    $valid=array();                        //si une plante est extraite ou non

    for($i=0;$i<$n;$i++){

        $es="espece" . $i;
        $var="var" . $i;
        $por_g="p_g" . $i;
        $nb="nb_p" . $i;

        $exist=false;
        foreach($list_p as $plant){
            if($_POST[$es]== $plant["espece"] && $_POST[$var]== $plant["variete"] && $_POST[$por_g]== $plant["porte_greffe"] && $_POST[$nb]<= $plant["nb"]){
                array_push($valid,1);

                $exist=true;

                $stock=$plant["nb"] - $_POST[$nb];

                $req_update_stock= $conn->prepare("UPDATE plant SET nb = :nb WHERE id_decl = :id;");
                $req_update_stock->bindParam(":id", $decl_id);
                $req_update_stock->bindParam(":nb", $stock);
                $req_update_stock->execute();

                if($stock == 0){
                    $req_suppr= $conn->prepare("DELETE FROM plant WHERE id_plant=:id_p;");
                    $req_suppr->bindParam(":id_p", $plant["id_plant"]);
                    $req_suppr->execute();
                }

                break;
            }else if($_POST[$es]== $plant["espece"] && $_POST[$var]== $plant["variete"] && $_POST[$por_g]== $plant["porte_greffe"] && $_POST[$nb]> $plant["nb"]){
                array_push($valid,0);
                $exist=true;
                break;
            }
        }
        if($exist==false){
            array_push($valid,0);
        }
    }
    

















    
    if(array_sum($valid)!=0){
        
        ?>
        <form class="form_hidden" action="imprimer.php" method="post">
            <?php 
            // Convertir les tableaux en chaînes JSON pour les envoyer dans un champ caché
            $valid_json = json_encode($valid);
            $cles = array_keys($_POST);
            
            ?>
            <input type="hidden" name="valid" value="<?php  echo $valid_json; ?>">

            <?php
            foreach($cles as $cle){
                ?>
                <input type="hidden" name="<?php echo $cle; ?>" value="<?php echo $_POST[$cle]; ?>">
                <?php
            }
            ?>
            <input type="submit" value="Envoyer" name="submit" id=but_hid>
        </form>

        <script>
        // Sélectionner le bouton par son identifiant
        var bouton = document.getElementById('but_hid');
        // Simuler un clic sur le bouton
        bouton.style.cssText=`display:none`;
        bouton.click();
        </script>

    <?php





















    }else{?>
    <script>
        alert("Le stock demandé est vide");
    </script>
    <?php
    }
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
        button{
            margin-left: 530px;
        }
        .form_hidden{
            border: 0;
        }
        img[alt="logo"]{
            width: 150px;
        }
        header{
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Demande du ACP/LP</title>
</head>
<body>
    <header>
        <a href="../php/index.php"><img src="../img/logo.png" alt="logo"></a> 
        <a href="../php/logout.php" class="btn btn-danger btn-lg">
            <span class="glyphicon glyphicon-off"></span> Sign Out 
        </a>
    </header>
    <div class="container">
        <h1>Demande ACP/LP</h1>
        <form action="" method="post" class="">
            <div class="form-group">
                <input class="form-control" type="text" name="dest" placeholder="Destination">
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="nb_v" placeholder="Nombre de total variétés concernées">
            </div>
            <div class="corps"></div>
            <button class="btn btn-success" type="submit" name="submit">Imprimer ACP/LP</button>
        </form>
    </div> 
    <script src="lp.js"></script>
</body>
</html>


