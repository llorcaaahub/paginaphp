<?php

    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    require '../vendor/autoload.php';

    if($_SERVER["REQUEST_METHOD"]!="POST"){
        header("Location:../index.php");
    }else{
        
        require_once('../ConexionDB/conexionBD.php');
        if( isset($_POST['usuari']) && isset($_POST['email']) && isset($_POST['password'])){
            $usuariIntroduit = $_POST['usuari'];
            $correuintroduit = $_POST['email'];
            $passwordintroduit = $_POST['password'];
            if(isset($_POST['nom']) && isset($_POST['cognom'])){
                $primernomintroduit = $_POST['nom'];
                $segonnomintroduit = $_POST['cognom'];
            }else{
                $primernomintroduit = "null";
                $segonnomintroduit = "null";
            }
            $horacreadacompte = date('Y\/m\/d G:i:s');
        }
        try{
            if(isset($usuariIntroduit) && isset($correuintroduit) && isset($passwordintroduit)){
                // Register
                $sql = 'SELECT mail, username FROM `users`';
                $usuaris = $db->query($sql);
                if($usuaris){
                    $existeix = false;
                    foreach ($usuaris as $fila) {
                        if($correuintroduit == $fila[0] || $usuariIntroduit == $fila[1]){
                                $existeix = true;
                                break;
                            }
                    }
                    if($existeix == true){
                        $missatge = "El usuari o correu que has indicat ja esta creat, prova de fer login amb ell :)";
                        echo "<script type='text/javascript'>
                                alert('$missatge');
                                window.location.href='../PC_FILES/PC_index.php';
                            </script>";
                    }else{
                        $passwordintroduit = password_hash($passwordintroduit, PASSWORD_DEFAULT);
                        if($_POST['password'] == $_POST['passwordverifica']){
                            $numerorandom = rand();
                            $numerorandom2 = rand();
                            $codirandom = hash("sha256",$numerorandom);
                            $codirandomreset = hash("sha256",$numerorandom2);
                            $insert = "insert into users (mail, username, passHash, userFirstName, userLastName, creationDate, active , activationCode, resetPassCode) values (:correu,:usu,:pass,:primnom,:segnom,:horacreada,'0',:codirandom, :resetPassCode);";
                            $preparada = $db->prepare($insert);
                            $preparada->execute(array(':correu' => $correuintroduit, ':usu' => $usuariIntroduit, ':pass' => $passwordintroduit, ':primnom' => $primernomintroduit, ':segnom' => $segonnomintroduit, ':horacreada' => $horacreadacompte , ':codirandom' => $codirandom , ':resetPassCode' => $codirandomreset));
                            enviarCorreu($codirandom, $correuintroduit);
                            
                        }else{
                            $missatge = "No has intorduit be les contrasenyes.";
                            echo "<script type='text/javascript'>
                                alert('$missatge');
                                window.location.href='../PC_FILES/PC_index.php'; 
                            </script>";
                        }
                        
                    }
                }
            }
            
        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
    }


    
    function enviarCorreu($codirandom, $correuintroduit){

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
        $mail->SetFrom('support@eduhacks.com','Soport de Eduhacks');
        $mail->Subject = 'Verificar Correu';
        $mail->MsgHTML('
            Clica aquesta link per verificar el correu
            <a href="http://localhost/lib/VerificarMail.php?code=' . $codirandom . '&mail=' . $correuintroduit . '">Verifica Correu</a>
        '); //text
        //$mail->addAttachment("fitxer.pdf");
        
        //Destinatari
        $address = $correuintroduit;
        $mail->AddAddress($address, 'Test');

        //Enviament
        $result = $mail->Send();
        if(!$result){
            echo 'Error: ' . $mail->ErrorInfo;
        }
        header("Location: ../index.php");
    }
?>