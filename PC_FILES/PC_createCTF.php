<?php 
    include_once("../lib/devicedetector.php");
    if(!isMobileDevice()){
        //Detecta que estas accedint desde un telefon
        if(isset($_COOKIE['PHPSESSID'])){
            session_start();
            if(isset($_SESSION['usuari'])){
                $usuari = $_SESSION['usuari'];
            }
        }else{
            header("Location:./PC_index.php");
        }
    // Si es mobil te lleva al home mobil o al index mobil si no estas logueado
    }else if(isMobileDevice()){
        header("Location:../PH_FILES/PH_index.php");
    }
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Eduhack - Crear CTF</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="../css/style-home.css">
</head>
<body class="body-create">
<div class="navbar">
  <a href="./PC_home.php" class="botons">Home</a>
  <a href="#" class="botons active">Crear CTF</a>
  <a href="./PC_ranking.php" class="botons">Ranking</a>
  <a href="../lib/logout.php" class="botons">Logout</a>
</div>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="d-flex justify-content-center eduhackslogin">Upload de CTF</h3>
				<div class="d-flex justify-content-end social_icon">
					<!-- <span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span> -->
				</div>
			</div>
                <div class="card-body">
                    <form name="form" action="../lib/crearCTF.php" method="POST" enctype="multipart/form-data">

                        <div class="input-group form-group">
                            <input type="text" class="form-control" placeholder="Titol" name="titol" required>
                        </div>

                        <div class="input-group form-group">
                            <input type="text" class="form-control" placeholder="Descripció" name="descripcio" required>
                        </div>

                        <div class="input-group form-group">
                            <input type="text" class="form-control" placeholder="Categories, separades per ',' " name="categories" required>
                        </div>

                        <div class="input-group form-group">
                            <input type="number" class="form-control" placeholder="Puntuacio" name="puntuacio"  min="5" max="20" required>
                        </div>

                        <div class="input-group form-group">
                            <input type="text" class="form-control" placeholder="Flag: '{flag}'" name="flag" required>
                        </div>

                        <div class="input-group form-group">
                                <input type="file" name="arxiu" id="actual-btn" placeholder="Posa aqui el teu arxiu" class="form-control placeholder label" aria-describedby="fileHelpId" hidden>
                                <label for="actual-btn" class="form-control placeholder label">Puja Arxiu</label>
                                <span class="custom-file-control"></span>
                        </div>

                        <div class="form-group centerbutton">
                            <input type="submit" value="Crea CTF" class="btn login_btn label">
                        </div>
                    

                    </form>
                </div>
        </div>
    </div>
</div>

</body>
</html>