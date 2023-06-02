<?php
session_start();
if (isset($_GET['first'])) {
    echo "<script>alert('Vous avez désormais un compte.')</script>";
}

if (isset($_GET['decl'])) {
    echo "<script>alert('Votre déclaration est bien enregistrée.')</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="client_page.css">

    <style>
        .modal-header, h4, .close {
            background-color: #5cb85c;
            color:white !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer {
            background-color: #f9f9f9;
        }

        .boite{
            border-radius: 10px;
        }
        .but_d{
          margin-left: 700px;
          margin-right: 10px;
        }
        a{
          all: unset;
        }
        a:hover{
          text-decoration: none;
          color: #fff;
        }
        .acp{
          
          margin-left: 900px;
        }
        .list{
            padding: 100px 50px 180px;
        }
        .li{
            font-size: large;
            padding: 30px !important;
            border-radius: 0;
        }
        h1{
            margin-top: 0;
            padding-top: 80px;
            border-bottom: solid 2px #fff;
        }
        body{
            background-image: url(../php/3.jpg); 
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
        }
        
        img[alt="logo"]{
            width: 120px;
        }
        .message{
            padding: 5px;
            color: #000;
            border: 1px solid black;
            border-radius: 5px;
        }
        .message:hover{
            background-color: lightgray;
        }
        .date{
            color:#000;
            display: flex;
            justify-content: space-between;
        }
    </style>
    <title>Ctrlpep</title>
</head>
<body>
    <header>
        <a href="../php/index.php"><img src="../img/logo.png" alt="logo"></a> 
        <a href="../php/logout.php" class="btn btn-danger btn-lg">
            <span class="glyphicon glyphicon-off"></span> Sign Out 
        </a>
    </header>
    <h1 class="container" >Bienvenue <?php echo $_SESSION["username"] ?></h1>
    <div class="container corps">
        <!--                              le corps                           -->
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-success btn-lg but_d"><a href="new_decl.php">Nouvelle déclaration</a> </button>
        <button type="button" class="btn btn-warning btn-lg but_m" id="myBtn">Boite messagerie</button>
        <div class="container" id="precess">
            <ul class="nav nav-pills nav-justified list" role="tablist">
                <li class="li_c"><a href="#" class="li">Déclaration</a></li>
                <li class="li_c"><a href="#" class="li">Contrôle documentaire</a></li>
                <li class="li_c"><a href="#" class="li">1er contrôle</a></li>
                <li class="li_c"><a href="#" class="li">2ème contrôle</a></li>        
            </ul>
        </div>
        
        <!--                               boite messagerie                                           -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content boite">
                    <div class="modal-header boite" style="padding:35px 50px;">
                        <h4><span class="glyphicon glyphicon-envelope"></span> Ma Boite Messagerie</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form">
                            <div id="corps" class="form-group">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer boite">
                        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    </div>
                </div>
            </div>
        </div> 
        <button type="button" class="btn btn-success btn-lg acp"><a href="lp.php">Demander ACP/LP</a> </button>
    </div>





<?php

include "connection.php";

$user=$_SESSION["username"];

//id des declarations
$list_decl= $conn->prepare("SELECT N_enregistr,date_decl FROM `declaration` WHERE `id_pep` = :user");
$list_decl->bindParam(":user", $user);
$list_decl->execute();
$list = $list_decl->fetchAll();


foreach($list as $decl){
    
    // les id du ctrl doc
    $select_ctrl_doc= $conn->prepare("SELECT id_ctrl_doc,date_ctrl_doc FROM `ctrl_doc` WHERE `id_decl` = :id");
    $select_ctrl_doc->bindParam(":id", $decl["N_enregistr"]);
    $select_ctrl_doc->execute();
    $ctrls_doc = $select_ctrl_doc->fetchAll();
    
    

    //si il y a au moins un ctrl doc
    if(count($ctrls_doc)>0){
        
        foreach($ctrls_doc as $ctrl_doc){
            
            //selecter le message
            $select_msg_ctrl_doc= $conn->prepare("SELECT Result_ctrl_doc FROM `courrier` WHERE `id_ctrl_doc` = :id");
            $select_msg_ctrl_doc->bindParam(":id", $ctrl_doc["id_ctrl_doc"]);
            $select_msg_ctrl_doc->execute();
            $msg_doc = $select_msg_ctrl_doc->fetchAll();
            $msg_doc=$msg_doc[0]["Result_ctrl_doc"];
            
            //envoyer le message ctrl doc
            //afficher le message et la date
            ?>
            <script>
                var message = <?php echo json_encode($msg_doc); ?>;
                var date = <?php echo json_encode($ctrl_doc['date_ctrl_doc']); ?>;
                console.log(date);
                var corps=document.getElementById("corps");
                corps.innerHTML+=`
                        <div class="date">
                            <span><strong>Control documentaire</strong></span>
                            <span><strong>${date}</strong></span>
                        </div>
                        <p class="message">${message}</p>
                `;
            </script>





            <?php 
            // <les id du ctrl1
            $select_ctrl1= $conn->prepare("SELECT id_ctrl1,date_ctrl1 FROM `ctrl1` WHERE `id_ctrl_doc` = :id");
            $select_ctrl1->bindParam(":id", $ctrl_doc["id_ctrl_doc"]);
            $select_ctrl1->execute();
            $ctrl1s = $select_ctrl1->fetchAll();

            //si il ya de ctrl1
            
            foreach($ctrl1s as $ctrl1){
                    
                //selecter le message
                $select_msg_ctrl1= $conn->prepare("SELECT Result_ctr1 FROM `courrier` WHERE `id_ctrl1` = :id");
                $select_msg_ctrl1->bindParam(":id", $ctrl1["id_ctrl1"]);
                $select_msg_ctrl1->execute();
                $msg1 = $select_msg_ctrl1->fetchAll();
                //afficher le message et la date
                ?>
                <script>
                    var message1 = <?php echo json_encode($msg1[0]["Result_ctr1"]); ?>;
                    var date1 = <?php echo json_encode($ctrl1["date_ctrl1"]); ?>;
                    var corps1=document.getElementById("corps");                  
                    
                    corps1.innerHTML+=`
                                <div class="date">
                                    <span><strong>Control Physique 1</strong></span>
                                    <span><strong>${date1}</strong></span>
                                </div>
                                <p class="message">${message1}</p>
                    `;
                </script>


                <?php
            }
        }
    }
}
 
    

//Traçons maintenant le processus et affichant les buttons nécéssaires


if(count($list)==0){
    ///traitement nouveau utilisateur
    ?>
    <script>
        var process=document.getElementById("precess");
        var acp=document.getElementsByClassName("acp")[0];
        process.style.cssText=`display:none`;
        acp.style.cssText=`display:none`;
    </script>
    <?php
    
}
else{
    $decl_cur=$list[count($list)-1];

    $date_cur=new DateTime($decl_cur['date_decl']);
    $d=new DateTime("-1 year");
    if($d>=$date_cur){
        //declaration terminée 
        ?>
        <script>
            var process=document.getElementById("precess");
            var acp=document.getElementsByClassName("acp")[0];
            process.style.cssText=`display:none`;
            acp.style.cssText=`display:none`;
        </script>
        <?php
    }else{
        //declaration en cours
        //id du ctrl doc
        $select_ctrl_doc= $conn->prepare("SELECT id_ctrl_doc FROM `ctrl_doc` WHERE id_ctrl_doc = (SELECT MAX(id_ctrl_doc) FROM ctrl_doc WHERE id_decl = :id)");
        $select_ctrl_doc->bindParam(":id", $decl_cur["N_enregistr"]);
        $select_ctrl_doc->execute();
        $ctrl_doc_cur = $select_ctrl_doc->fetchAll();
        
        if(count($ctrl_doc_cur)==0){
            //ctrl doc pas encore fait
            ?>
            <script>
                var decl=document.getElementsByClassName("but_d")[0];
                var acp=document.getElementsByClassName("acp")[0];
                var elem=document.getElementsByTagName("li")[0];
                var m_b=document.getElementsByClassName("but_m")[0];
                elem.classList.add("active");
                acp.style.cssText=`display:none`;
                decl.style.cssText=`display:none`;
                m_b.style.cssText=`margin-left: 900px;`;
            </script>
            <?php
        }else{
            //id du ctrl1
            $select_ctrl1= $conn->prepare("SELECT id_ctrl1 FROM `ctrl1` WHERE `id_ctrl1` = (SELECT MAX(id_ctrl1) FROM `ctrl1` WHERE `id_ctrl_doc` =:id)");
            $select_ctrl1->bindParam(":id", $ctrl_doc_cur[0]["id_ctrl_doc"]);
            $select_ctrl1->execute();
            $ctrl1_cur = $select_ctrl1->fetchAll();
            

            if(count($ctrl1_cur)==0){
                //ctrl1 pas encore fait
                ?>
                <script>
                var decl=document.getElementsByClassName("but_d")[0];
                var acp=document.getElementsByClassName("acp")[0];
                var elem0=document.getElementsByTagName("li")[0];
                var elem1=document.getElementsByTagName("li")[1];
                var m_b=document.getElementsByClassName("but_m")[0];
                elem0.classList.add("active");
                elem1.classList.add("active");
                acp.style.cssText=`display:none`;
                decl.style.cssText=`display:none`;
                m_b.style.cssText=`margin-left: 900px;`;
                </script>
                <?php
            }else{
                $select_ctrl2= $conn->prepare("SELECT id_ctrl2,conform FROM `ctrl2` WHERE `id_ctrl2` =(SELECT MAX(id_ctrl2) FROM `ctrl2` WHERE id_ctrl1=:id)");
                $select_ctrl2->bindParam(":id", $ctrl1_cur[0]["id_ctrl1"]);
                $select_ctrl2->execute();
                $ctrl2 = $select_ctrl2->fetchAll();
                

                if(count($ctrl2)==0 || $ctrl2[0]["conform"]!="conforme"){
                    
                    //ctrl2 pas encore fait ou non conforme
                    ?>
                    <script>
                    var decl=document.getElementsByClassName("but_d")[0];
                    var acp=document.getElementsByClassName("acp")[0];
                    var elem0=document.getElementsByTagName("li")[0];
                    var elem1=document.getElementsByTagName("li")[1];
                    var elem2=document.getElementsByTagName("li")[2];
                    var m_b=document.getElementsByClassName("but_m")[0];
                    elem0.classList.add("active");
                    elem1.classList.add("active");
                    elem2.classList.add("active");
                    acp.style.cssText=`display:none`;
                    decl.style.cssText=`display:none`;
                    m_b.style.cssText=`margin-left: 900px;`;
                    </script>
                    <?php
                }else{
                    //processus terminé
                    ?>
                    <script>
                    var elem=document.getElementsByTagName("li");
                    for(let k=0;k<elem.length;k++){
                        elem[k].classList.add("active");
                    }
                    </script>
                    <?php
                }
            }
        }
    }
   
}

?>





<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>

</body>
</html>


