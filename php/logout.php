<?php  

session_start();
$Etat = $_SESSION['Etat'];
$id_decl = $_SESSION['id_decl'];
$N_enregistr = $_SESSION['N_enregistr'];
$id_ctrl_doc = $_SESSION['id_ctrl_doc'];
$id_ctrl1 = $_SESSION['id_ctrl1'];
$id_ctrl2 = $_SESSION['id_ctrl2'];
//session_unset();
session_destroy();
session_start();
$_SESSION['Etat']= $Etat;
$_SESSION['id_decl']= $id_decl;
$_SESSION['N_enregistr']= $N_enregistr;
$_SESSION['id_ctrl_doc']= $id_ctrl_doc;
$_SESSION['id_ctrl1']= $id_ctrl1;
$_SESSION['id_ctrl2']= $id_ctrl2;


header("Location: index.php");
