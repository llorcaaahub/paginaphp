<?php
    session_start();
    require_once('../ConexionDB/conexionBD.php');

    function selectCTF($idctf,$database){
        $selectctf = 'SELECT flag,puntuacio FROM ctf WHERE idctf = :idctf ;';
        $ctf2 = $database->prepare($selectctf);
        $ctf2->execute(array(':idctf' => $idctf));
        $ctf = $ctf2->fetch(PDO::FETCH_ASSOC);
        return $ctf;
    };

    function selectPuntuacio($iduser, $database){
        $selectpuntuacio = "SELECT puntuacio FROM puntuacio WHERE iduser = :iduser ;";
        $preparada = $database->prepare($selectpuntuacio);
        $preparada->execute(array(':iduser' => $iduser));
        $fila = $preparada->fetch(PDO::FETCH_ASSOC);
        return $fila;
    };

    function insertCompletarCTF($database,$idctf,$iduser,$fechaCompletat){
        $insert = "insert into `completarctf` (idctf, iduser, AchieveDate) values ( :idctf, :iduser, :dataIntroduida);";
        $preparada = $database->prepare($insert);
        $preparada->execute(array(':idctf' => $idctf , ':iduser' => $iduser , ':dataIntroduida' => $fechaCompletat));
    };

    function selectIDuser($user,$database){
        $selectidusu = "SELECT `iduser` from `users` WHERE `username` = '$user';";
        $iduser = $database->prepare($selectidusu);
        $iduser->execute();
        $fila = $iduser->fetch(PDO::FETCH_ASSOC);
        $iduser = (int)$fila['iduser'];
        return $iduser;
    };

    function insertPuntuacio($database,$iduser,$user,$puntuacio){
        $insert = "INSERT INTO puntuacio (iduser,nom_user,puntuacio) VALUES (:iduser , :nomuser , :puntuacio) ;";
        $preparada = $database->prepare($insert);
        $preparada->execute(array(':iduser' => $iduser , ':nomuser' =>  $user ,':puntuacio' => $puntuacio));
    };

    function insertde0Puntuacio($fila,$database,$iduser,$puntuacio){
        $puntuacioctfactual = (int)$fila['puntuacio'];
        $puntuaciofinal = $puntuacioctfactual + $puntuacio;
        $update = "UPDATE puntuacio SET puntuacio = :puntuacio WHERE iduser = :iduser ;";
        $preparada = $database->prepare($update);
        $preparada->execute(array(':iduser' => $iduser , ':puntuacio' => $puntuaciofinal));
    };

    $flagIntroduida = $_POST['flag'];
    $idctf = (int)$_POST['idctf'];
    $ctf = selectCTF($idctf,$db);
    if(password_verify($flagIntroduida, $ctf['flag'])){
        //Agafem les variables que farem servir previament per buscar la persona que ha ti
        $user = $_SESSION['usuari'];
        $fechaCompletat =  date('Y\/m\/d G:i:s');
        //Aqui fem la consulta per conseguir la id de usuari
        $iduser = selectIDuser($user,$db);
        //Aqui fem la introduccio quan completa el ctf
        insertCompletarCTF($db,$idctf,$iduser,$fechaCompletat);
        //Aqui agafem els punts del ctf que acaba de superar
        $puntuacio = (int)$ctf['puntuacio'];
        //Aqui fem una consulta dels punts que te l'usuari que ha superat el ctf, si no te cap superat es mostrara com a false
        $fila = selectPuntuacio($iduser, $db);
        if($fila == false){
            //Aqui es fara la introduccio a dins de l'usuari a dins de la taula de puntuacio
            insertPuntuacio($db,$iduser,$user,$puntuacio);
        }elseif($fila != false){
            //Aqui es fara el  update a la taula i sumare els punts que ja tenia als del ctf actual
            insertde0Puntuacio($fila,$db,$iduser,$puntuacio);
        }
        $missatge = "Molt be! Has conseguit superar el CTF!";
            echo "<script type='text/javascript'>
                             alert('$missatge');
                             window.location.href='../PH_FILES/PH_home.php';
                         </script>";
    }else{
        $missatge = "Has fallat! Torna a intentar.";
            echo "<script type='text/javascript'>
                             alert('$missatge');
                             window.location.href='../PH_FILES/PH_home.php';
                         </script>";
    }
?>