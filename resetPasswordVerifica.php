<?php
    require_once("./ConexionDB/conexionBD.php");
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        
        $codi = $_GET['code'];
        $mail = $_GET['mail'];
        $sql = 'SELECT resetPassCode as codi ,mail FROM users where resetPassCode = :codi and mail = :mail and expireDate >= now();';
        $resetear = $db->prepare($sql);
        $resetear->execute(array(':codi' => $codi, ':mail' => $mail));        
        $fila = $resetear->fetch(PDO::FETCH_ASSOC);
        if (!isset($fila['codi'])){
            header("Location:./index.php");
        }
    }else{
        if($_SERVER["REQUEST_METHOD"]=="POST"){
			if(isset($_POST['password']) && isset($_POST['password_verifica']) && isset($_POST['email']) && isset($_POST['codi_reset'])){
				if($_POST['password']==$_POST['password_verifica']){
					$codi = $_POST['codi_reset'];
					$mail = $_POST['email'];
					$password_nova = $_POST['password'];
					$sql = 'SELECT resetPassCode as codi ,mail FROM users where resetPassCode = :codi and mail = :mail;';
					$resetear = $db->prepare($sql);
					$resetear->execute(array(':codi' => $codi, ':mail' => $mail));
					$fila = $resetear->fetch(PDO::FETCH_ASSOC);
					if (!isset($fila['codi'])){
						header("Location: index.php");
					}else{
						$password_nova=password_hash($password_nova, PASSWORD_DEFAULT);
						$codirandomresetnou = hash("sha256",rand());
						$sql = 'UPDATE users SET passHash = :pass , resetPassCode = :noucodi WHERE resetPassCode = :codi and mail = :mail;';
						$resetear = $db->prepare($sql);
						$resetear->execute(array(':codi' => $codi, ':mail' => $mail, ':pass' => $password_nova , ':noucodi' => $codirandomresetnou));
						header("Location: index.php");
					}
				}else{
					header("Location: index.php");
				}
			}
		}
    }
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Eduhack - Recuperar Contraseña</title>  
	<!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="video_contain">
	<video autoplay muted loop id="myVideo">
		<source src="./videos/videoReset.mp4" type="video/mp4">
	</video>
</div>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="d-flex justify-content-center">Reset Password de EduHack</h3>
				<div class="d-flex justify-content-end social_icon">
					<!-- <span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span> -->
				</div>
			</div>
			<div class="card-body">
				<form name="form" action="./resetPasswordVerifica.php" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Introdueix la nova contraseña" name="password">
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Reintrodueix la teva contrasenya" name="password_verifica">
					</div>
						<input type="hidden" class="form-control" name="email" value="<?php echo $fila['mail']; ?>">
						<input type="hidden" class="form-control" name="codi_reset" value="<?php echo $fila['codi']; ?>">
					</div>
					<div class="card-footer">
						<input type="submit" value="Envia Reset" class="btn float-right login_btn boton">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>