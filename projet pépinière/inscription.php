

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
    <script src="submit.js"></script>
    
    <title>Inscription</title>
</head>
<body>
    <header><a href="../php/index.php"><img src="../img/logo.png" alt="logo" width=120px></a></header>
    <div class="container">
        <h1>Inscription</h1>

        <form onsubmit="return validerFormulaire()" action="inscription.php" method="post">
            <div>
                <div class="phrase">Vous êtes une personne physique ou morale?</div>
                <div class="p_m">
                    <div class="p">
                        <label for="p" class="radioLabel" onclick="click_p()">Physique</label>
                        <input type="radio" name="pers" id="p" value="p">
                    </div>
                    <div class="m">
                        <label for="m" class="radioLabel" onclick="click_m()">Morale</label>
                        <input type="radio" name="pers" id="m" value="m">
                    </div>
                </div>
            </div>

            <div class="corps">
        </div>
        </form>
    </div>
    <script src="conn.js"></script>
    
</body>
</html>




<?php

if(isset($_POST["submit"])){
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    $type=$_POST["pers"];
    
    include "connection.php";

    //verifier si L'utilisateur physique existe déjà 
    if($type=="p"){
        $cin=$_POST["cin"];
        $p_ph_list = $conn->prepare("SELECT COUNT(*) FROM `personne_physique` WHERE `cin` = :cin");
        $p_ph_list->bindParam(":cin", $cin);
        $p_ph_list->execute();
        $p_ph_nbre = $p_ph_list->fetchColumn();
        if ($p_ph_nbre > 0) {
            header("Location: inscription.php?error=compte_existant&type=p");
            exit(); // Arrêter l'exécution du script
        }
    }

    //verifier si L'utilisateur morale existe déjà 
    if($type=="m"){
        $ice=$_POST["ice"];
        $p_m_list = $conn->prepare("SELECT COUNT(*) FROM `personne_morale` WHERE `ice` = :ice");
        $p_m_list->bindParam(":ice", $ice);
        $p_m_list->execute();
        $p_m_nbre = $p_m_list->fetchColumn();
        if ($p_m_nbre > 0) {
            header("Location: inscription.php?error=compte_existant");
            exit(); // Arrêter l'exécution du script
        }
    }
    
    // Vérifier si le username est déjà utilisé
    $user_list = $conn->prepare("SELECT COUNT(*) FROM `pep` WHERE `username` = :user");
    $user_list->bindParam(":user", $user);
    $user_list->execute();
    $user_nbre = $user_list->fetchColumn();
    
    if ($user_nbre > 0) {
        if($type=="p"){
            header("Location: inscription.php?error=username_taken&type=p");
            exit(); // Arrêter l'exécution du script
        }else{
            header("Location: inscription.php?error=username_taken");
            exit(); // Arrêter l'exécution du script
        }
        
    }
         




    //enregistrement du user
    $p=md5($pass);
    $req=$conn->prepare("INSERT INTO `pep` VALUES ( :user, :pass, 'Pepinieriste');");
    $req->bindParam(":user",$user);
    $req->bindParam(":pass",$p);
    $req->execute();

    //enregistrement physique
    if($type=="p"){
        $n_pepist=$_POST["n_pepinierist"];
        
        $tel=$_POST["tel"];
        $ad=$_POST["adress"];
        $n_pep=$_POST["n_pep"];
        $ad_pep=$_POST["adress_pep"];

        $req1=$conn->prepare("INSERT INTO `personne_physique` VALUES ( :cin, :n, :ad,:tel,:ad_p,:n_p,:id_p);");
        $req1->bindParam(":cin",$cin);
        $req1->bindParam(":n",$n_pepist);
        $req1->bindParam(":ad",$ad);
        $req1->bindParam(":tel",$tel);
        $req1->bindParam(":ad_p",$ad_pep);
        $req1->bindParam(":n_p",$n_pep);
        $req1->bindParam(":id_p",$user);
        $req1->execute();
    }else{                        //enregistrement morale
        $ice=$_POST["ice"];
        $rc=$_POST["rc"];
        $tel=$_POST["tel"];
        $n_pep=$_POST["n_pep"];
        $ad_pep=$_POST["adress_pep"];

        $req1=$conn->prepare("INSERT INTO `personne_morale` VALUES ( :ice, :rc, :n,:ad,:tel,:id_p);");
        $req1->bindParam(":ice",$ice);
        $req1->bindParam(":n",$n_pep);
        $req1->bindParam(":ad",$ad_pep);
        $req1->bindParam(":tel",$tel);
        $req1->bindParam(":rc",$rc);
        $req1->bindParam(":id_p",$user);
        $req1->execute();
    }
    header("Location:inscription.php?error=none&user=$user");

}


?>




<?php
if (isset($_GET['error']) && $_GET['error'] === 'compte_existant') {
    echo "<script>alert('Vous avez déjà un compte.')</script>";
    if(isset($_GET['type']) && $_GET['type'] === 'p'){
        echo "<script>let b_p=document.getElementsByClassName(\"radioLabel\")[0];b_p.click();</script>";
    }else{
        echo "<script>let b_m=document.getElementsByClassName(\"radioLabel\")[1];b_m.click();</script>";
    }
    
}

if (isset($_GET['error']) && $_GET['error'] === 'username_taken') {
    echo "<script>alert('Le nom d\'utilisateur est déjà pris. Veuillez choisir un autre nom d\'utilisateur.')</script>";
    if(isset($_GET['type']) && $_GET['type'] === 'p'){
        echo "<script>let b_p=document.getElementsByClassName(\"radioLabel\")[0];b_p.click();</script>";
    }else{
        echo "<script>let b_m=document.getElementsByClassName(\"radioLabel\")[1];b_m.click();</script>";
    }
    
}
if (isset($_GET['error']) && $_GET['error'] === 'none') {
    session_start();
    $_SESSION["username"]=$_GET["user"];
    header("Location: client_page.php?first=true");
}
?>