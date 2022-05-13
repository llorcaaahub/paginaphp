<?php
    include_once("../lib/devicedetector.php");
    if(!isMobileDevice()){
        if(isset($_COOKIE['PHPSESSID'])){
            session_start();
            if(isset($_SESSION['usuari'])){
                    
            }else{
                header("Location:./PC_index.php");
            }
        }
    }else if(isMobileDevice()){
        header("Location:../PH_FILES/PH_index.php");
    }
    require_once("../ConexionDB/conexionBD.php");

    function selectIDuser($user,$database){
        $selectidusu = "SELECT `iduser` from `users` WHERE `username` = '$user';";
        $iduser = $database->prepare($selectidusu);
        $iduser->execute();
        $fila = $iduser->fetch(PDO::FETCH_ASSOC);
        $iduser = (int)$fila['iduser'];
        return $iduser;
    };


    $categoria = $_GET["categoria"];
    
    $select = "SELECT count(categoria_pertany.idctf) as cantitat
    FROM categories JOIN categoria_pertany ON categoria_pertany.idcategoria = categories.idcategoria
    WHERE categories.nom_categoria = :categoria ;";
    $existeix = $db->prepare($select);
    $existeix->execute(array(':categoria' => $categoria));
    $fila = $existeix->fetch(PDO::FETCH_ASSOC);
    $cantitatArray = (int)$fila["cantitat"];

    $select = "SELECT categoria_pertany.idctf as idctf
    FROM categories JOIN categoria_pertany ON categoria_pertany.idcategoria = categories.idcategoria
    WHERE categories.nom_categoria = '$categoria';";
    $existeix = $db->prepare($select);
    $existeix->execute();

    $i = 0;

    

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
        <link rel="stylesheet" type="text/css" href="../css/style-filtrar.css">
    </head>
    <body class="body-create">
    <div class="navbar">
    <a href="./PC_home.php" class="botons">Home</a>
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
        <div class='container bajar'>
                <div class='d-flex justify-content-center h-100'>
                    <div class='card'>  
        <?php
        if($cantitatArray == 0){
            echo "<div class='fondo-pc'>
            <p class='d-flex titol2' style='text-align: center;'>No hi ha cap CTF amb la categoria que has indicat.</p>
            </div>";
        }elseif($cantitatArray != 0){
            for($i = 0; $i < $cantitatArray; $i++){
                $fila = $existeix->fetch(PDO::FETCH_ASSOC);
                $idctf = $fila["idctf"];
                $user = $_SESSION['usuari'];
                $iduser = selectIDuser($user,$db);
            
                $consultacompletat = "SELECT idctf, iduser FROM completarctf WHERE idctf = $idctf AND iduser = $iduser;";
                $consultacompletat2 = $db->prepare($consultacompletat);
                $consultacompletat2->execute();
                $consultacompletat = $consultacompletat2->fetch(PDO::FETCH_ASSOC);
                
                if($consultacompletat != false){
                    $completat = true;
                }else{
                    $completat = false;
                }
            
                
                
                $selectctf = "SELECT idctf,titol,descripcio,fitxerPath,puntuacio,flag from `ctf` WHERE idctf = '$idctf';";
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
                for ($z = 1; $z <= $cantitatcategories; $z++) {
                    $categoria3 = $categoria2->fetch(PDO::FETCH_ASSOC);
                    $categories = $categories . " #" . $categoria3['categoria'];
                } 
                
                echo "  
                    
                            <div class='card-header fondo-card borde headshot'>
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
                                        <h1 style='color: #FFC312; font-size: 25px;'> Descripció:</h1>
                                    </div>
                                    <div class='input-group'>
                                        <h1 style='color:white; font-size: 20px;'>" . $ctf['descripcio'] . "</h1><br>  
                                    </div>
                                    <br>";
                                
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
                                    
                                    
                                    if($completat == false){
                                        echo "
                                                <form name='form' action='../lib/validarflag.php' method='POST' enctype='multipart/form-data'>
                                                    
                                                    <div class='input-group form-group'>
                                                        <div class='input-group-prepend'>
                                                            <span class='input-group-text'><i class='fas fa-user'></i></span>
                                                        </div>
                                                        <input type='text' class='form-control' placeholder='Introdueix aqui la teva flag' name='flag' required>
                                                    </div>
            
                                                        <input type='hidden' name='idctf' value=" . $idctf . ">
            
                                                    <div class='form-group centerbutton'>
                                                        <input type='submit' value='Enviar Solució' class='btn login_btn placeholder-ctf'>
                                                    </div>    
            
                                                </form>
                                            </div>
                                        </div>";
                                    }else{
                                        echo "<div class='fuente animate-me fuente2'>Ja has completat el ctf!</div>" . 
                                        "</div>
                                        </div>";
                                    }
                                    
                                echo "\n";
                            }
        }
        


        ?>
                </div>
            </div>
        </div>
    </body>
</html>