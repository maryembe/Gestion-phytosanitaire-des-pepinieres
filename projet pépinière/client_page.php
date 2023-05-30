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
            padding-top: 50px;
            border-bottom: solid 2px #fff;
        }
        body{
            background-image: url(../php/3.jpg); 
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
        }
        
    </style>
    <title>Ctrlpep</title>
</head>
<body>
    <header><img src="" alt="logo"></header>
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
    
    //id du ctrl doc
    $select_ctrl_doc= $conn->prepare("SELECT id_ctrl_doc,date FROM `ctrl_doc` WHERE `id_decl` = :id");
    $select_ctrl_doc->bindParam(":id", $decl["N_enregistr"]);
    $select_ctrl_doc->execute();
    $ctrl_doc = $select_ctrl_doc->fetchAll();

    //si il n'ya pas de ctrl doc
    if(count($ctrl_doc)==0){
        break;
    }

    //selecter le message
    $select_msg_ctrl_doc= $conn->prepare("SELECT Result_ctrl_doc FROM `courrier` WHERE `id_ctrl_doc` = :id");
    $select_msg_ctrl_doc->bindParam(":id", $ctrl_doc[0]["id_ctrl_doc"]);
    $select_msg_ctrl_doc->execute();
    $msg_doc = $select_msg_ctrl_doc->fetch();
    $msg_doc=$msg_doc[0];
    

    //envoyer le message ctrl doc
    //afficher le message et la date
    ?>
    <script>
        // Utilisez la variable $msg_doc ici
        var message = <?php echo json_encode($msg_doc); ?>;
        var date = <?php echo json_encode($ctrl_doc[0]['date']); ?>;
        console.log(date);
        var corps=document.getElementById("corps");
        corps.innerHTML+=`<label for="usrname"><strong>${date}</strong></label>
                        <input type="text" class="form-control" value=${message}>
        `;
    </script>
    <?php

    //id du ctrl1
    
    $select_ctrl1= $conn->prepare("SELECT id_ctrl1,date FROM `ctrl1` WHERE `id_ctrl_doc` = :id");
    $select_ctrl1->bindParam(":id", $ctrl_doc[0]["id_ctrl_doc"]);
    $select_ctrl1->execute();
    $ctrl1 = $select_ctrl1->fetchAll();
    
    //si il n'ya pas de ctrl1
    if(count($ctrl1)==0){
        break;
    }

    //selecter le message
    $select_msg_ctrl1= $conn->prepare("SELECT Result_ctr1 FROM `courrier` WHERE `id_ctrl1` = :id");
    $select_msg_ctrl1->bindParam(":id", $ctrl1[0]["id_ctrl1"]);
    $select_msg_ctrl1->execute();
    $msg1 = $select_msg_ctrl1->fetchAll();
    //afficher le message et la date
    ?>
    <script>
        // Utilisez la variable $msg1 ici
        var message1 = <?php echo json_encode($msg1[0]['Result_ctr1']); ?>;
        var date1 = <?php echo json_encode($ctrl1[0]['date']); ?>;
        console.log(message1);
        var corps=document.getElementById("corps");
        corps.innerHTML+=`<label for="usrname"><strong>${date1}</strong></label>
                        <input type="text" class="form-control" value=${message1}>
        `;
    </script>
    <?php
}


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
    if($d==$date_cur){
        //declaration terminée 
        ?>
        <script>
            var elem=document.getElementsByTagName("li");
            for(let k=0;k<elem.length;k++){
                elem[k].classList.add("active");
            }
        </script>
        <?php
    }else{
        //declaration en cours
        //id du ctrl doc
        $select_ctrl_doc= $conn->prepare("SELECT id_ctrl_doc FROM `ctrl_doc` WHERE `id_decl` = :id");
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
            $select_ctrl1= $conn->prepare("SELECT id_ctrl1 FROM `ctrl1` WHERE `id_ctrl_doc` = :id");
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
                $select_ctrl2= $conn->prepare("SELECT id_ctrl2 FROM `ctrl2` WHERE `id_ctrl1` = :id");
                $select_ctrl2->bindParam(":id", $ctrl1_cur[0]["id_ctrl1"]);
                $select_ctrl2->execute();
                $ctrl2_cur = $select_ctrl2->fetchAll();

                if(count($ctrl2_cur)==0){
                    //ctrl2 pas encore fait
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


