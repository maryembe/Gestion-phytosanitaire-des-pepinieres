

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="inscription.css">
    <style>
        body{
            color: black;
        }
        p{
            margin-left: 80px ;
            border-bottom: solid 2px #000;
            margin-right: 550px;
        }
        label{
            margin-left: 20px;
        }
    </style>
    <title>Inscription</title>
</head>
<body>
    <!--<header><img src="" alt="logo"></header>-->
    <div class="container">
        <h1>Demande ACP/LP</h1>
        <form >
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
                <p><strong> Variété <?php echo $i +1 ?></strong></p>
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

