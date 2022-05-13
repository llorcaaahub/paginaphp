<?php

    use PHPMailer\PHPMailer\PHPMailer;
    require '../vendor/autoload.php';

    if($_SERVER["REQUEST_METHOD"]!="POST"){
        header("Location:../index.php");
    }else{
        require_once('../ConexionDB/conexionBD.php');
    }
    
    

    if( isset($_POST['mail_reset'])){
        if (strpos($_POST["mail_reset"], '@') !== false) {
            $mailReset = $_POST['mail_reset'];
            $sql = 'SELECT resetPassCode as codi FROM users WHERE mail = :mail;';
            $reset = $db->prepare($sql);
            $reset->execute(array(':mail' => $mailReset));
            $fila = $reset->fetch(PDO::FETCH_ASSOC);
            $expiredate = 'UPDATE users SET expireDate = addtime(now(),100) WHERE mail = :mail AND resetPassCode = :codi;';
            $resetear = $db->prepare($expiredate);
            $resetear->execute(array(':mail' => $mailReset, ':codi' => $fila['codi']));
			enviarCorreu($mailReset, $fila['codi']);
            header("Location:../index.php");
        }
    }

    
    //$fila['resetPassCode'])

    function enviarCorreu($correuintroduit,$codiReset){

        $mail = new PHPMailer();
        $mail->IsSMTP();

        //Configuració del servidor de Correu
        //Modificar a 0 per eliminar msg error
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        
        //Credencials del compte GMAIL
        $mail->Username = ''; 
        $mail->Password = '';

        //Dades del correu electrònic
        $mail->SetFrom('support@eduhacks.com','Suport de Eduhacks');
        $mail->Subject = 'Reset de Contraseña';
        $mail->MsgHTML('
            Clica aquesta link per cambiar la contraseña
            <a href="http://localhost/PC_FILES/PC_resetPasswordVerifica.php?code=' . $codiReset . '&mail=' . $correuintroduit .'">Cambiar Contraseña</a>
            ');
        $address = $correuintroduit;
        $mail->AddAddress($address, 'Test');

        //Enviament
        $result = $mail->Send();
        if(!$result){
            echo 'Error: ' . $mail->ErrorInfo;
        }
    }

?>