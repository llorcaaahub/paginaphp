<?php 
    include_once("../lib/devicedetector.php");
    if(!isMobileDevice()){
        if(isset($_COOKIE['PHPSESSID'])){
            session_start();
            if(isset($_SESSION['usuari'])){
                    
            }
        }
    }else if(isMobileDevice()){
        header("Location:../PH_FILES/PH_index.php");
    }

    
    require_once('../ConexionDB/conexionBD.php');

    $ultimaid = 'SELECT idctf from `ctf` ORDER BY 1 DESC LIMIT 1;';
    $ctf2 = $db->prepare($ultimaid);
    $ctf2->execute();
    $idcomprovantexisteix = $ctf2->fetch(PDO::FETCH_ASSOC);
    if($idcomprovantexisteix == false){
        
    }elseif($idcomprovantexisteix != false){
        $ultimaid = $idcomprovantexisteix['idctf'];
        $selectctf = "SELECT idctf,titol,descripcio,fitxerPath,puntuacio,flag from `ctf` WHERE idctf = $ultimaid ;";
        $ctf2 = $db->prepare($selectctf);
        $ctf2->execute();
        $ctf = $ctf2->fetch(PDO::FETCH_ASSOC);

        $idctf = intval($ctf['idctf']);

        $user = $_SESSION['usuari'];
        $selectidusu = "SELECT `iduser` from `users` WHERE `username` = '$user';";
        $id = $db->prepare($selectidusu);
        $id->execute();
        $fila = $id->fetch(PDO::FETCH_ASSOC);
        $iduser = (int)$fila['iduser'];

        $consultacompletat = "SELECT idctf, iduser FROM completarctf WHERE idctf = $idctf AND iduser = $iduser;";
        $consultacompletat2 = $db->prepare($consultacompletat);
        $consultacompletat2->execute();
        $consultacompletat = $consultacompletat2->fetch(PDO::FETCH_ASSOC);
        //echo "Aixo es per debuggar GON, no t'enfadis";
        if($consultacompletat != false){
            while($consultacompletat != false){
                $idctf = $idctf - 1;
                $consultacompletat = "SELECT idctf, iduser FROM completarctf WHERE idctf = $idctf AND iduser = $iduser;";
                $consultacompletat2 = $db->prepare($consultacompletat);
                $consultacompletat2->execute();
                $consultacompletat = $consultacompletat2->fetch(PDO::FETCH_ASSOC);
            }
        }
        $selectctf = "SELECT idctf,titol,descripcio,fitxerPath,puntuacio,flag from `ctf` WHERE idctf = $idctf ;";
        $ctf2 = $db->prepare($selectctf);
        $ctf2->execute();
        $ctf = $ctf2->fetch(PDO::FETCH_ASSOC);

        $selectcountcategories = "SELECT count(categories.nom_categoria) as cantitat
        FROM categoria_pertany INNER JOIN categories
        ON categories.idcategoria = categoria_pertany.idcategoria
        INNER JOIN ctf
        ON ctf.idctf = categoria_pertany.idctf
        WHERE ctf.idctf = '$idctf' ;";
        $countcategories2 = $db->prepare($selectcountcategories);
        $countcategories2->execute();
        $countcategories = $countcategories2->fetch(PDO::FETCH_ASSOC);
        $cantitatcategories = $countcategories['cantitat'];

        $selectcategoria = "SELECT ctf.idctf, categories.idcategoria, categories.nom_categoria as categoria
        FROM categoria_pertany INNER JOIN categories
        ON categories.idcategoria = categoria_pertany.idcategoria
        INNER JOIN ctf
        ON ctf.idctf = categoria_pertany.idctf
        WHERE ctf.idctf = '$idctf' ;";
        $categoria2 = $db->prepare($selectcategoria);
        $categoria2->execute();
        
        $categories = "";
        for ($i = 1; $i <= $cantitatcategories; $i++) {
            $categoria = $categoria2->fetch(PDO::FETCH_ASSOC);
            $categories = $categories . " #" . $categoria['categoria'];
        } 

    }
?>

<!DOCTYPE html>
<html>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<head>
	<title>Eduhack - Home</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="../css/style-home.css">
    <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>
    <script src="myscripts.js"></script>
</head>
<body class="body-create">
<div class="navbar">
  <a href="./PC_home.php" class="botons active">Home</a>
  <a href="./PC_createCTF.php" class="botons">Crear CTF</a>
  <a href="./PC_ranking.php" class="botons">Ranking</a>
  <a href="../lib/logout.php" class="botons">Logout</a>
</div>

<div class="box center">
        <form name='form' action='./PC_filtrecategoria.php' method='get' enctype='multipart/form-data'>
            <input type="text" class="input" name="categoria" 
            onmouseout="document.search.txt.value = ''">
        </form>
            <i class="fas fa-search"></i>
</div>
<?php
if($idcomprovantexisteix != false && $idctf != 0){
    echo "
        <div class='container'>
            <div class='d-flex justify-content-center h-100'>
                <div class='card'>
                <h1 class='d-flex titol'>EduHacks</h1>
                    <div class='card-header'>        
                    </div>
                        <div class='card-body'>
  
                     
                            <div>
                                <div class='fif titol2 fuente'>" . $ctf['titol'] . "</div><div class='fif fuente puntos'>+" . $ctf['puntuacio'] . " pts</div>
                            </div>

                            <br>" .
                            "<div class='input-group'>
                            <br>
                                <h1 style='color:white; font-size: 15px;'>" . $categories . "</h1><br>  
                            </div>
                            <br>" . 
                            "<div class='input-group'>
                                <h1 style='color: #FFC312; font-size: 25px;'> Descripci??:</h1>
                            </div>
                            <div class='input-group'>
                                <h1 style='color:white; font-size: 20px;'>" . $ctf['descripcio'] . "</h1><br>  
                            </div>
                            <br>";
                            ?>
                            <?php
                                $fitxerPath = $ctf['fitxerPath'];
                                $fitxer = explode("/", $fitxerPath);
                                if($fitxerPath != null){
                                    echo 
                                    "<div class='input-group form-group'>
                                        <h5 style='color:#FFC312'>Descarrega l'arxiu: <a href=' $fitxerPath ' download>" . $fitxer[2] . "</h5> </a>
                                    </div>";
                                }elseif($fitxerPath == null){
                                    "<div class='input-group form-group'>
                                        <h1></a>
                                    </div>";
                                }
                            ?>
                            <?php

                            echo "
                            <form name='form' action='../lib/validarflag.php' method='POST' enctype='multipart/form-data'>
                                
                                <div class='input-group form-group'>
                                    <input type='text' class='form-control' placeholder='Introdueix aqui la teva flag' name='flag' required>
                                </div>

                                    <input type='hidden' name='idctf' value=" . $idctf . ">

                                <div class='form-group centerbutton'>
                                    <input type='submit' value='Enviar Soluci??' class='btn login_btn placeholder-ctf'>
                                </div>    

                            </form>
                        </div>
                </div>
            </div>
        </div>

        ";
}elseif($idcomprovantexisteix == false || $idctf == 0){
    echo "<div class='fondo-pc'>
            <p class='d-flex titol2' style='text-align: center;'>Has completat tots els CTF o no hi ha cap disponible</p>
        </div>";
}
?>

</body>
</html>
