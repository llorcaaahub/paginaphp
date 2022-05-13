<?php

    function selectIdCTF($database){
        $selectidctf = 'SELECT `idctf` from `ctf` ORDER BY 1 DESC LIMIT 1;';
        $numero = $database->prepare($selectidctf);
        $numero->execute();
        $fila = $numero->fetch(PDO::FETCH_ASSOC);
        return $fila;
    };

    function selectIdUsuari($database,$usuari){
        $selectidusu = "SELECT `iduser` from `users` WHERE `username` = '$usuari';";
        $idfinal = $database->prepare($selectidusu);
        $idfinal->execute();
        $fila = $idfinal->fetch(PDO::FETCH_ASSOC);
        $idfinal = (int)$fila['iduser'];
        return $idfinal;
    };

    function insertarCTFArxiu($database,$titol,$descripcio,$puntuacio,$datapublicacio,$destfile,$flag,$iduser){
        $flag = password_hash($flag, PASSWORD_DEFAULT);
        $insert = "insert into ctf (titol, descripcio, puntuacio, dataPublicacio, fitxerPath, flag , iduser) values (:titol,:desc,:puntuacio,:data,:path,:flag,:id);";
        $preparada = $database->prepare($insert);
        $preparada->execute(array(':titol' => $titol, ':desc' => $descripcio, ':puntuacio' => $puntuacio, ':data' => $datapublicacio, ':path' => $destfile, ':flag' => $flag , ':id' => $iduser ));
    };

    function insertarCTFSenseArxiu($database,$titol,$descripcio,$puntuacio,$datapublicacio,$flag,$iduser){
        $flag = password_hash($flag, PASSWORD_DEFAULT);
        $insert = "insert into ctf (titol, descripcio, puntuacio, dataPublicacio, flag , iduser) values (:titol,:desc,:puntuacio,:data,:flag,:id);";
        $preparada = $database->prepare($insert);
        $preparada->execute(array(':titol' => $titol, ':desc' => $descripcio, ':puntuacio' => $puntuacio, ':data' => $datapublicacio, ':flag' => $flag , ':id' => $iduser ));
    };

    function selectTotCategories($database,$categoriabenescrita){
        $selectidcategoria = "SELECT * from `categories` WHERE nom_categoria = :categoria ;";
        $existeix = $database->prepare($selectidcategoria);
        $existeix->execute(array(':categoria' => $categoriabenescrita));
        $fila = $existeix->fetch(PDO::FETCH_ASSOC);
        return $fila;
    };

    function insertCategoria($database,$categoriabenescrita){
        $insertescrit = "INSERT INTO `categories` (nom_categoria) VALUES (:categoria);";
        $insert = $database->prepare($insertescrit);
        $insert->execute(array(':categoria' => $categoriabenescrita));
    };
    
    function selectIdCategoria($database,$categoriabenescrita){
        $selectidcategoria = "SELECT idcategoria FROM categories WHERE nom_categoria = :categoria;";
        $existeix = $database->prepare($selectidcategoria);
        $existeix->execute(array(':categoria' => $categoriabenescrita));
        $idcategoria = $existeix->fetch(PDO::FETCH_ASSOC);
        return $idcategoria;
    };

    function insertCtfPertany($database,$idcategoria,$idctf){
        $insertctfpertany = "INSERT INTO `categoria_pertany` (idctf,idcategoria) VALUES (:idctf ,:idcategoria );";
        $insereix = $database->prepare($insertctfpertany);
        $insereix->execute(array( ':idctf' => $idctf , ':idcategoria' => $idcategoria['idcategoria']));
    };

    function missatgeRedirect(){
        $missatge = "Sha publicat el ctf correctament";
            echo "<script type='text/javascript'>
                             alert('$missatge');
                             window.location.href='./index.php';
                         </script>";
    };

    session_start();
    //Aqui entra si posa file
    if ( $_FILES['arxiu']["name"] != "" ) {
        require_once('../ConexionDB/conexionBD.php');
        $source_file = $_FILES['arxiu']['name'];
        $imageFileType = strtolower(pathinfo($source_file,PATHINFO_EXTENSION));
        if($imageFileType != "php" ) {
            // Fem un select per trobar la idctf, per despres afegirla al nom de l'arxiu
            $fila = selectIdCTF($db);
            if($fila == false){
                $numero = 0;
            }else{
                $numero = (int)$fila['idctf'];
            }
            
            // Aqui es fa un selet per aconseguir la ultima id de ctf i se li suma 1 (Per fer lactual)
            $numerofinal = $numero + 1;

            // Agafem l'extensio de l'arxiu 
            $extensio = explode(".",$_FILES['arxiu']['name']);
            $cantitatextensions = count($extensio); 

            // Dades del form pasades per POST            
            $titol = $_POST["titol"];
            $descripcio = $_POST["descripcio"];
            $categories = strtolower($_POST["categories"]);
            $flag = $_POST["flag"];
            $puntuacio = $_POST["puntuacio"];

            // Agafem la id d'usuari y fem una data de publicacio
            $usuari = $_SESSION['usuari'];
            $datapublicacio =  date('Y\/m\/d G:i:s');

            $id = selectIdUsuari($db,$usuari);

            // Fem una variable amb el directori per pujar l'arxiu i fem upload de l'arxiu
            $directori = "../CTF_files/";
            $source_file_xampp = $_FILES['arxiu']['tmp_name'];
            $dest_file = $directori."CTF_file_".$numerofinal.".".$extensio[$cantitatextensions-1];
            move_uploaded_file( $source_file_xampp, $dest_file ) or die("Error no sha pogut penjar l'arxiu correctament!!");
            
            insertarCTFArxiu($db,$titol,$descripcio,$puntuacio,$datapublicacio,$dest_file,$flag,$id);
            
            $fila = selectIdCTF($db);
            if($fila == false){
                $numero = 0;
            }else{
                $idctf = (int)$fila['idctf'];
            }

            //Introduccio de les categories
            $categoriesarray = explode("#",$categories);
            $cantitatArray = count($categoriesarray);
            
            $i = 1;
            while ($i < $cantitatArray ) {
                $categoriabenescrita = str_replace(" ", "", $categoriesarray[$i]); 
                $fila = selectTotCategories($db,$categoriabenescrita);
                
                if($fila == false){
                    //Aqui introduirem la categoria que previament haurem comprobat que no existeix
                    insertCategoria($db,$categoriabenescrita);
                }
                $idcategoria = selectIdCategoria($db,$categoriabenescrita);
                insertCtfPertany($db,$idcategoria,$idctf);
                $i++;
            }
            missatgeRedirect();
        }else if($imageFileType == "php" ){

            $missatge = "Padre, prova de pujar algo que no sigui un reverse shell";
            echo "<script type='text/javascript'>
                            alert('$missatge');
                            window.location.href='./index.php';
                        </script>";
        }
    }

    //Aqui entra si no posa file
    if ( $_FILES['arxiu']["name"] == "" ) {
            
        require_once('../ConexionDB/conexionBD.php');
    
        //Dades del form pasades per POST            
        $titol = $_POST["titol"];
        $descripcio = $_POST["descripcio"];
        $categories = strtolower($_POST["categories"]);
        $flag = $_POST["flag"];
        $puntuacio = $_POST["puntuacio"];

        //Agafem la id d'usuari y fem una data de publicacio
        $usuari = $_SESSION['usuari'];
        $datapublicacio =  date('Y\/m\/d G:i:s');

        $id = selectIdUsuari($db,$usuari);

        insertarCTFSenseArxiu($db,$titol,$descripcio,$puntuacio,$datapublicacio,$flag,$id);
            
        $fila = selectIdCTF($db);
        if($fila == false){
            $numero = 0;
        }else{
            $idctf = (int)$fila['idctf'];
        }

        $categoriesarray = explode("#",$categories);
        $cantitatArray = count($categoriesarray);

        $i = 1;
        while ($i < $cantitatArray ) {
            $categoriabenescrita = str_replace(" ", "", $categoriesarray[$i]); 
            
            $fila = selectTotCategories($db,$categoriabenescrita);
            if($fila == false){
                //Aqui introduirem la categoria que previament haurem comprobat que no existeix
                insertCategoria($db,$categoriabenescrita);               
            }
            $idcategoria = selectIdCategoria($db,$categoriabenescrita);

            insertCtfPertany($db,$idcategoria,$idctf);
        
            $i++;
        }
        missatgeRedirect();
    }
?>