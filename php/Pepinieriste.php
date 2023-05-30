<?php 
   session_start();
   include "db_conn.php";?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
    </head>
    <body>
<div class="card" style="width: 18rem;">
			  <img src="../img/user-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['username']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
            </body>
</html>