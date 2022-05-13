<?php
    
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        require_once("../ConexionDB/conexionBD.php");
        $codi = $_GET['code'];
        $mail = $_GET['mail'];
        $sql = 'SELECT activationCode as codi ,mail FROM users where activationCode = :codi and mail = :mail;';
        $activar = $db->prepare($sql);
        $activar->execute(array(':codi' => $codi, ':mail' => $mail));
        //$activar = $db->query($sql);
        $horaVerificadaCompte = date('Y\/m\/d G:i:s');
        $fila = $activar->fetch(PDO::FETCH_ASSOC);
        if (isset($fila['mail']) && isset($fila['codi'])){
            $update = "update users set active = 1, activationDate = :fecha where activationCode = :codi;";
            $preparada = $db->prepare($update);
            $preparada->execute(array(':fecha' => $horaVerificadaCompte, ':codi' => $fila['codi']));

        }
    }
    header("Location: ../index.php");
?>