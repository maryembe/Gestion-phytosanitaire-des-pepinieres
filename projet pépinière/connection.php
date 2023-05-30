<?php
$db="database";
$host="localhost";
$dbus="root";
$dbpass="";

try{
    $conn=new PDO("mysql:hast=$host;dbname=$db",$dbus,$dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'Echec';
}
?>