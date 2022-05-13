<?php
	include_once("../lib/devicedetector.php");
    if(isMobileDevice()){
        if(isset($_COOKIE['PHPSESSID'])){
            session_start();
            if(isset($_SESSION['usuari'])){
                    header("Location:./PH_home.php");
            }
        }
    }else if(!isMobileDevice()){
        header("Location:../PC_FILES/PC_index.php");
    }
	
	    	
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Eduhack - Login</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="../css/PH_styles.css">
</head>
<body>
	
<div class="video_contain">
	<video autoplay muted loop id="myVideo">
		<source src="../videos/videoIndex.mp4" type="video/mp4">
	</video>
</div>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="d-flex justify-content-center eduhackslogin">Login de EduHack</h3>
				<div class="d-flex justify-content-end social_icon">
					<!-- <span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span> -->
				</div>
			</div>
			
			<div class="card-body">
				<form name="form" action="../lib/controlUsuariLogin.php" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control placeholder" placeholder="Usuari" name="usuari_login">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control placeholder" placeholder="Contrasenya" name="password_login">
					</div>
					<div class="row align-items-center text-checkbox">
						<input type="checkbox" class="remember">Recorda'm
					</div>
					<div class="boton justify-content-center">
						<input type="submit" value="Login" class="btn login_btn placeholder">
					</div>
				</form>
			</div>
			<div class="card-footer">
			<div class=" text justify-content-center links">
					<a href="./PH_resetPassword.php">No recordo la contrasenya</a>
				</div>
				<div class="text d-flex justify-content-center links ">
					No tens un compte?<a href="./PH_register.php">Registra't</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
</body>
</html>