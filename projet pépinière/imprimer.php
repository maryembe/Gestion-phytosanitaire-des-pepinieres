<?php
session_start();
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
        p{
            margin-left: 50px;
            margin-top: 20px;
        }
        p.title{
            margin-left: 80px ;
            border-bottom: solid 2px #fff;
            margin-right: 550px;
            width: 80px;
        }
        label{
            margin-left: 20px;
        }
        .info{
            display: grid;
            grid-template-rows: auto auto; 
            grid-template-columns: 205px 400px;
            
        }
        .p{
            margin: 5px 0;
            word-wrap: break-word;
            
        }
        .t{
            justify-self: start;
        }
        form{
            margin-left: 150px;
            margin-right: 150px;
        }
    </style>
    <title>Inscription</title>
</head>
<body>
    <header><img src="../img/logo.png" alt="logo" width=120px></header>
    <div class="container">
        <h1>Demande ACP/LP</h1>
        <form >
        <?php 
        include "connection.php";
        //extraire les données du user

        //s'il s'agit d'une personne physique
        $user=$_SESSION["username"];
        $import_phy= $conn->prepare("SELECT * FROM `pep` INNER JOIN `personne_physique` ON pep.username = personne_physique.id_pep WHERE pep.username = :user");
        $import_phy->bindParam(":user", $user);
        $import_phy->execute();
        $pers_phy = $import_phy->fetchAll();
        if(count($pers_phy)==1){
            $pers_phy=$pers_phy[0];
            
            ?>
            <div class="info">
                <div class="p t">Nom:</div>
                <div class="p"><?php echo $pers_phy["nom"]?></div>
                <div class="p t">CIN:</div>
                <div class="p"><?php echo $pers_phy["CIN"]?></div>
                <div class="p t">Adresse personnelle:</div>
                <div class="p"><?php echo $pers_phy["adresse"]?></div>
                <div class="p t">Tel:</div>
                <div class="p"><?php echo $pers_phy["tel"]?></div>
                <div class="p t">Nom de la pépinière:</div>
                <div class="p"><?php echo $pers_phy["nom_pep"]?></div>
                <div class="p t">Adresse de la pépinière:</div>
                <div class="p"><?php echo $pers_phy["adresse_pep"]?></div>
            </div>
            
            <?php
        }else{
            //s'il s'agit d'une personne morale
            
            $import_mor= $conn->prepare("SELECT * FROM `pep` INNER JOIN `personne_morale` ON pep.username = personne_morale.id_pep WHERE pep.username = :user");
            $import_mor->bindParam(":user", $user);
            $import_mor->execute();
            $pers_mor = $import_mor->fetchAll();
            $pers_mor=$pers_mor[0];
            

            ?>
            <div class="info">
                <div class="p t">Nom de l'entreprise:</div>
                <div class="p"><?php echo $pers_mor["nom"]?></div>
                <div class="p t">ICE:</div>
                <div class="p"><?php echo $pers_mor["ICE"]?></div>
                <div class="p t">RC:</div>
                <div class="p"><?php echo $pers_mor["RC"]?></div>
                <div class="p t">Adresse de l'entreprise:</div>
                <div class="p"><?php echo $pers_mor["adresse"]?></div>
                <div class="p t">Tel:</div>
                <div class="p"><?php echo $pers_mor["tel"]?></div>
            </div>
            
            
            <?php
        }
        ?>
        
        
        
        <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $valid_json = $_POST["valid"];
        
                // Convertir les chaînes JSON en tableaux
                $valid = json_decode($valid_json);
                
            }?>
            <div class="form-group">
                <label for="">Destination</label>
                <input class="form-control" type="text" name="dest" value="<?php echo $_POST["dest"] ?>">
            </div>
            <?php
            for($i=0;$i<count($valid);$i++){
                if($valid[$i]==0){
                    continue;
                }
                $es="espece" . $i;
                $var="var" . $i;
                $por_g="p_g" . $i;
                $nb="nb_p" . $i;
                ?>
                <p class="title"><strong> Variété <?php echo $i +1 ?></strong></p>
                <div class="form-group">
                    <label for="">espece</label>
                    <input class="form-control" type="text" name="espece${i}" value="<?php echo $_POST[$es]; ?>">
                </div>
                <div class="form-group">
                <label for="">variete</label>
                    <input class="form-control" type="text" name="var${i}" value="<?php echo $_POST[$var]; ?>">
                </div>
                <div class="form-group">
                <label for="">porte-greffe</label>
                    <input class="form-control" type="text" name="p_g${i}" value="<?php echo $_POST[$por_g]; ?>">
                </div>
                <div class="form-group">
                <label for="">nombre de plante à extraire</label>
                    <input class="form-control" type="text" name="nb_p${i}" value="<?php echo $_POST[$nb]; ?>">
                </div>
            <?php
            }
            ?>
        </form>
    </div> 
    <script>
    print();
    </script>
</body>
</html>

